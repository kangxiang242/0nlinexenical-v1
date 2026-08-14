<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use App\Models\Order;
use Illuminate\Support\HtmlString;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static ?string $navigationGroup = '客服管理';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = '訊息管理';

    public static function getNavigationLabel(): string
    {
        return '訊息管理';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('訊息內容')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('姓名')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('電話')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title')
                            ->label('主旨')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('content')
                            ->label('內容')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('type')
                            ->label('類型')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('ip')
                            ->label('IP位址')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('user_agent')
                            ->label('User Agent')
                            ->maxLength(65535),
                        Forms\Components\TextInput::make('ipcountry')
                            ->label('地區')
                            ->readOnly()
                            ->formatStateUsing(fn ($state) => $state ? self::countryName($state) : ''),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('關聯訂單')
                    ->schema([
                        Forms\Components\Placeholder::make('related_orders')
                            ->label('')
                            ->content(function ($record) {
                                if (!$record || (empty($record->phone) && empty($record->email))) {
                                    return '無聯絡方式，無法關聯訂單';
                                }

                                $orders = self::relatedOrders($record);
                                if ($orders->isEmpty()) {
                                    $contact = $record->phone ?? $record->email;
                                    return '該聯絡方式（' . e($contact) . '）無對應訂單';
                                }

                                $html = '<table style="width:100%;border-collapse:collapse;font-size:13px">';
                                $html .= '<thead><tr style="background:#f3f4f6">';
                                $html .= '<th style="padding:8px;text-align:left;border-bottom:2px solid #e5e7eb">訂單號</th>';
                                $html .= '<th style="padding:8px;text-align:left;border-bottom:2px solid #e5e7eb">總價</th>';
                                $html .= '<th style="padding:8px;text-align:left;border-bottom:2px solid #e5e7eb">配送方式</th>';
                                $html .= '<th style="padding:8px;text-align:left;border-bottom:2px solid #e5e7eb">狀態</th>';
                                $html .= '<th style="padding:8px;text-align:left;border-bottom:2px solid #e5e7eb">時間</th>';
                                $html .= '</tr></thead><tbody>';

                                foreach ($orders as $order) {
                                    $status = Order::STATUS_TXT[$order->status] ?? $order->status;
                                    $hasShopData = !empty($order->shop_name) || !empty($order->shop_no);
                                    if ($hasShopData) {
                                        $delivery = !empty($order->shop_type) ? (Order::SHOP_TYPE_TXT[$order->shop_type] ?? '7-11 超商') : '7-11 超商';
                                    } elseif ($order->delivery_type !== null && $order->delivery_type !== '') {
                                        $delivery = Order::DELIVERY_TYPE_TXT[$order->delivery_type] ?? '宅配到府';
                                    } else {
                                        $delivery = '宅配到府';
                                    }

                                    $html .= '<tr>';
                                    $html .= '<td style="padding:8px;border-bottom:1px solid #e5e7eb"><a href="' . \App\Filament\Resources\OrderResource::getUrl('edit', ['record' => $order]) . '" target="_blank" style="color:#2563eb">' . e($order->no) . '</a></td>';
                                    $html .= '<td style="padding:8px;border-bottom:1px solid #e5e7eb">NT$' . number_format($order->total_price) . '</td>';
                                    $html .= '<td style="padding:8px;border-bottom:1px solid #e5e7eb">' . e($delivery) . '</td>';
                                    $html .= '<td style="padding:8px;border-bottom:1px solid #e5e7eb">' . e($status) . '</td>';
                                    $html .= '<td style="padding:8px;border-bottom:1px solid #e5e7eb">' . $order->created_at->format('Y-m-d H:i') . '</td>';
                                    $html .= '</tr>';
                                }
                                $html .= '</tbody></table>';
                                return new HtmlString($html);
                            }),
                    ])->visible(fn ($record) => $record && (!empty($record->phone) || !empty($record->email))),
            ]);
    }

    public static function table(Table $table): Table
    {
        // 统计每个 IP 的留言数
        $ip_counts = \App\Models\Message::select('ip', \Illuminate\Support\Facades\DB::raw('count(*) as ip_counts'))
            ->groupBy('ip')->pluck('ip_counts', 'ip');

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('姓名')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('電話')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('主旨')
                    ->limit(30)
                    ->searchable(),
                Tables\Columns\TextColumn::make('content')
                    ->label('內容')
                    ->limit(40)
                    ->toggleable(),
                                Tables\Columns\TextColumn::make('ip')
                    ->label('IP')
                    ->width(140)
                    ->alignLeft()
                    ->formatStateUsing(function ($record) use ($ip_counts) {
                        $count = \Illuminate\Support\Arr::get($ip_counts, $record->ip, 0);
                        $country = $record->ipcountry ? self::countryName($record->ipcountry) : '未知';
                        return '<p style="width:130px;overflow:hidden;margin:0">' . e($record->ip) . '</p>'
                            . '<p style="text-align:center;margin:0">' . e($country) . '</p>'
                            . '<p style="text-align:center">共' . $count . '條</p>';
                    })
                    ->html()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('related_orders')
                    ->label('關聯訂單')
                    ->html()
                    ->getStateUsing(function ($record) {
                        if (empty($record->phone) && empty($record->email)) return '';
                        $relatedOrders = self::relatedOrders($record);
                        if ($relatedOrders->isEmpty()) return '';
                        $html = '';
                        foreach ($relatedOrders as $i => $order) {
                            if ($i > 0) $html .= '<br>';
                            $status = Order::STATUS_TXT[$order->status] ?? $order->status;
                            $html .= e($order->no) . ' <span style="color:#6b7280;font-size:0.85em">[' . e($status) . ']</span>';
                        }
                        return $html;
                    })
                    ->tooltip(function ($record) {
                        if (empty($record->phone) && empty($record->email)) return null;
                        $orders = self::relatedOrders($record);
                        if ($orders->isEmpty()) return null;
                        $lines = [];
                        foreach ($orders as $order) {
                            $status = Order::STATUS_TXT[$order->status] ?? $order->status;
                            $lines[] = $order->no . ' (' . $status . ') NT$' . number_format($order->total_price);
                        }
                        return implode("\n", $lines);
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('建立時間')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('ipcountry')
                    ->label('地區')
                    ->options(function () {
                        $codes = Message::query()->whereNotNull('ipcountry')->distinct()->pluck('ipcountry');
                        $options = [];
                        foreach ($codes as $code) {
                            $options[$code] = self::countryName($code);
                        }
                        return $options;
                    }),
                Tables\Filters\Filter::make('created_at')
                    ->label('建立日期')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('開始日期'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('結束日期'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'], fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
                            ->when($data['created_until'], fn ($query, $date) => $query->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->form([
                        Forms\Components\TextInput::make('name')->label('姓名'),
                        Forms\Components\TextInput::make('phone')->label('電話'),
                        Forms\Components\TextInput::make('email')->label('Email'),
                        Forms\Components\TextInput::make('title')->label('主旨'),
                        Forms\Components\Textarea::make('content')->label('內容')->columnSpanFull(),
                        Forms\Components\TextInput::make('ip')->label('IP位址'),
                        Forms\Components\TextInput::make('user_agent')->label('User Agent'),
                        Forms\Components\TextInput::make('created_at')->label('建立時間'),
                    ]),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool { return false; }

    private static function relatedOrders($record)
    {
        if (! $record || (empty($record->phone) && empty($record->email))) {
            return collect();
        }
        return Order::query()
            ->where(function ($q) use ($record) {
                $q->when($record->phone, fn ($q2, $v) => $q2->where('phone', $v))
                  ->when($record->email, fn ($q2, $v) => $q2->orWhere('email', $v));
            })
            ->orderByDesc('created_at')
            ->get();
    }

    private static function countryName($code)
    {
        $map = [
            'TW' => '台灣', 'HK' => '香港', 'MO' => '澳門', 'CN' => '中國大陸',
            'US' => '美國', 'JP' => '日本', 'KR' => '韓國', 'SG' => '新加坡',
            'MY' => '馬來西亞', 'TH' => '泰國', 'VN' => '越南', 'PH' => '菲律賓',
            'ID' => '印尼', 'AU' => '澳洲', 'GB' => '英國', 'CA' => '加拿大',
            'DE' => '德國', 'FR' => '法國', 'NL' => '荷蘭',
        ];
        return $map[$code] ?? $code;
    }
}
