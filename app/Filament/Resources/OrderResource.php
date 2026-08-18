<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';


    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = '訂單管理';
    protected static ?string $modelLabel = '訂單';
    protected static ?string $pluralModelLabel = '訂單管理';

    public static function getNavigationLabel(): string
    {
        return '訂單管理';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('訂單資訊')
                    ->schema([
                        Forms\Components\TextInput::make('no')
                            ->label('訂單編號')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('inside_no')
                            ->label('內部單號')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('name')
                            ->label('收件人姓名')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('收件人電話')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('total_price')
                            ->label('總價')
                            ->required()
                            ->numeric()
                            ->prefix('NT$'),
                        Forms\Components\TextInput::make('product_price')
                            ->label('商品總價')
                            ->numeric()
                            ->prefix('NT$'),
                        Forms\Components\TextInput::make('freight')
                            ->label('運費')
                            ->numeric()
                            ->prefix('NT$'),
                        Forms\Components\Select::make('delivery_type')
                            ->label('配送方式')
                            ->options(Order::DELIVERY_TYPE_TXT)
                            ->default(0),
                        Forms\Components\Select::make('delivery_time')
                            ->label('配送時段')
                            ->options(Order::DELIVERY_TIME),
                        Forms\Components\Select::make('payment_type')
                            ->label('付款方式')
                            ->options([
                                '0' => '貨到付款',
                            ]),
                        Forms\Components\Select::make('status')
                            ->label('訂單狀態')
                            ->options(Order::STATUS_TXT)
                            ->default(0),
                        Forms\Components\Textarea::make('remarks')
                            ->label('備註')
                            ->maxLength(65535),
                        Forms\Components\TextInput::make('country')
                            ->label('國家')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('province')
                            ->label('省份')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('city')
                            ->label('城市')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('county')
                            ->label('區/縣')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('street')
                            ->label('街道')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->label('詳細地址')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('商店資訊')
                    ->schema([
                        Forms\Components\TextInput::make('shop_name')
                            ->label('商店名稱')
                            ->maxLength(255),
                        Forms\Components\Select::make('shop_type')
                            ->label('商店類型')
                            ->options(Order::SHOP_TYPE_TXT),
                        Forms\Components\TextInput::make('shop_no')
                            ->label('商店編號')
                            ->maxLength(255),
                        Forms\Components\KeyValue::make('shop_data')
                            ->label('商店資料'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('技術資訊')
                    ->schema([
                        Forms\Components\TextInput::make('ip')
                            ->label('IP位址')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('ipcountry')
                            ->label('IP地區')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('user_agent')
                            ->label('User Agent')
                            ->maxLength(65535),
                        Forms\Components\TextInput::make('is_test')
                            ->label('是否測試')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('release_token')
                            ->label('釋放Token')
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->selectable()
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->label('訂單號')
                    ->searchable()
                    ->sortable()
                    ->size('sm')
                    ,
                Tables\Columns\TextColumn::make('total_price')
                    ->label('金額')
                    ->sortable()
                    ->money('TWD')
                    ->size('sm')
                    ,
                Tables\Columns\TextColumn::make('products')
                    ->label('商品信息')
                    ->html()
                    ->wrap()
                    
                    ->getStateUsing(function ($record) {
                        $html = '';
                        foreach ($record->products as $item) {
                            $productName = e($item->product_name);
                            $html .= '<p style="width: 300px">' . $productName . '<span>(' . $item->number . '件)</span></p>';
                        }
                        return $html;
                    })
                    ->action(Tables\Actions\Action::make('view_products')
                        ->modalHeading('商品明細')
                        ->modalContent(fn ($record) => new \Illuminate\Support\HtmlString(
                            view('filament.modals.order-products', ['order' => $record])->render()
                        ))
                        ->modalSubmitAction(false)
                        ->modalCancelActionLabel('關閉')
                        ->modalWidth('lg')),
                Tables\Columns\TextColumn::make('name')
                    ->label('收貨人信息')
                    ->searchable()
                    ->html()
                    ->wrap()
                    ->disabledClick()
                    ->formatStateUsing(function ($record) {
                        $nameCounts = \App\Models\Order::select('name', \Illuminate\Support\Facades\DB::raw('count(*) as cnt'))
                            ->groupBy('name')->pluck('cnt', 'name');
                        $count = $nameCounts[$record->name] ?? 0;
                        return '<p style="margin:0">' . '<a href="?name=' . e($record->name) . '">' . e($record->name) . '</a>'
                            . '<span>（' . $count . '）</span></p>'
                            . '<p style="margin:0"><a href="?phone=' . e($record->phone) . '">' . e($record->phone) . '</a></p>'
                            . '<p style="margin:0"><a href="?email=' . e($record->email) . '">' . e($record->email) . '</a></p>';
                    }),
                Tables\Columns\TextColumn::make('delivery_type')
                    ->label('配送方式')
                    
                    ->formatStateUsing(function ($record) {
                        $hasShopData = !empty($record->shop_name) || !empty($record->shop_no);

                        if ($hasShopData) {
                            if (!empty($record->shop_type)) {
                                return \App\Models\Order::SHOP_TYPE_TXT[$record->shop_type] ?? '7-11 超商';
                            }
                            return '7-11 超商';
                        }

                        if ($record->delivery_type !== null && $record->delivery_type !== '') {
                            return \App\Models\Order::DELIVERY_TYPE_TXT[$record->delivery_type] ?? '宅配到府';
                        }

                        return '宅配到府';
                    }),
                Tables\Columns\TextColumn::make('address')
                    ->label('地址')
                    ->html()
                    ->wrap()
                    
                    ->formatStateUsing(function ($record) {
                        if ($record->delivery_type > 0) {
                            $shopData = $record->shop_data ? (is_array($record->shop_data) ? $record->shop_data : json_decode($record->shop_data, true)) : null;
                            $shopAddr = $shopData['shop_address'] ?? $record->address ?? '';
                            $shopName = e($record->shop_name ?? '未知門市');
                            $shopNo = e($record->shop_no ?? '');
                            return '<p style="width: 150px">' . $shopName . '【' . $shopNo . '】<br/>' . e($shopAddr) . '</p>';
                        }
                        return '<p style="width: 150px">' . e($record->city . $record->county . $record->street . $record->address) . '</p>';
                    })
                    ->action(Tables\Actions\Action::make('view_address')
                        ->modalHeading('配送地址')
                        ->modalContent(fn ($record) => new \Illuminate\Support\HtmlString(
                            view('filament.modals.order-address', ['order' => $record])->render()
                        ))
                        ->modalSubmitAction(false)
                        ->modalCancelActionLabel('關閉')
                        ->modalWidth('lg')),
                Tables\Columns\SelectColumn::make('status')
                    ->label('訂單狀態')
                    ->options(\App\Models\Order::STATUS_TXT)
                    ,

                Tables\Columns\TextColumn::make('user_agent')
                    ->label('瀏覽器')
                    ->html()
                    ->formatStateUsing(function ($record) {
                        $ua = $record->user_agent;
                        if (!$ua) {
                            return '';
                        }
                        $device = \App\Handlers\DeviceTypeHandlers::getDevice($ua);
                        $browser = \App\Handlers\DeviceTypeHandlers::getBrowser($ua);
                        return '<p style="margin:0">' . e($device) . '</p>'
                             . '<p style="margin:0;font-size:0.75rem;color:#6b7280">' . e($browser ?? '未知') . '</p>';
                    })
                    ->tooltip(fn ($record) => $record->user_agent)
                    ,
                Tables\Columns\TextColumn::make('remarks')
                    ->label('備注')
                    ->limit(15)
                    ->action(null)
                    ->tooltip(fn ($record) => $record->remarks),
                Tables\Columns\TextColumn::make('ip')
                    ->label('IP')
                    ->searchable()
                    ->html()
                    ->wrap()
                    
                    ->formatStateUsing(function ($record) {
                        $ipCounts = \App\Models\Order::select('ip', \Illuminate\Support\Facades\DB::raw('count(*) as cnt'))
                            ->groupBy('ip')->pluck('cnt', 'ip');
                        $count = $ipCounts[$record->ip] ?? 0;
                        $html = '<p style="width: 130px;overflow: hidden;margin: 0">' . e($record->ip) . '</p>';
                        $html .= '<p style="margin: 0">' . e($record->ipcountry) . '</p>';
                        $html .= '<p>共' . $count . '單</p>';
                        return $html;
                    }),
                Tables\Columns\TextColumn::make('version')
                    ->label('版本')
                    ->size('sm')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('下單時間')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->size('sm')
                    ->wrap(),
            ])
            ->searchable(false)
            ->defaultSort('created_at', 'desc')
            ->paginated([20, 50, 100])
            ->defaultPaginationPageOption(20)
            ->filtersLayout(FiltersLayout::AboveContent)
            ->filters([
                Tables\Filters\Filter::make('email')
                    ->label('郵箱')
                    ->form([
                        Forms\Components\TextInput::make('email')
                            ->label('郵箱')
                            ->placeholder('輸入郵箱搜索'),
                    ])
                    ->query(fn (Builder $query, array $data) =>
                        $query->when($data['email'], fn (Builder $q, $value) => $q->where('email', 'like', "%{$value}%"))
                    ),
                Tables\Filters\SelectFilter::make('status')
                   ->label('訂單狀態')
                   ->options(\App\Models\Order::STATUS_TXT),
                Tables\Filters\SelectFilter::make('hide_test')
                    ->label('隱藏測試單')
                    ->options([
                        '' => '否',
                        '1' => '是',
                    ])
                    ->default('')
                    ->query(function (Builder $query, array $data) {
                        if (!($data['hide_test'] ?? false)) {
                            return;
                        }
                        $query->where(function (Builder $q) {
                            $q->where('is_test', 0)
                              ->where('name', 'not like', 'test%')
                              ->where('name', 'not like', '%测试%')
                              ->where('name', 'not like', '%測試%')
                              ->where('name', '!=', 'RainGor Ye');
                        });
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('quick_view')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('查看完整資訊')
                    ->modalHeading('訂單資訊')
                    ->modalContent(fn ($record) => new \Illuminate\Support\HtmlString(
                        view('filament.modals.order-detail', ['order' => $record])->render()
                        . '<div class="border-t pt-4 mt-4">'
                        . view('filament.modals.order-products', ['order' => $record])->render()
                        . '</div><div class="border-t pt-4 mt-4">'
                        . view('filament.modals.order-recipient', ['order' => $record])->render()
                        . '</div><div class="border-t pt-4 mt-4">'
                        . view('filament.modals.order-address', ['order' => $record])->render()
                        . '</div><div class="border-t pt-4 mt-4">'
                        . view('filament.modals.order-device', ['order' => $record])->render()
                        . '</div>'
                    ))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('關閉')
                    ->modalWidth('2xl'),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('update_status')
                    ->label('批量修改狀態')
                    ->icon('heroicon-o-pencil-square')
                    ->color('primary')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label('訂單狀態')
                            ->options(\App\Models\Order::STATUS_TXT)
                            ->required(),
                    ])
                    ->action(function (\Illuminate\Support\Collection $records, array $data) {
                        $records->each(fn (Order $record) => $record->update(['status' => $data['status']]));
                        \Filament\Notifications\Notification::make()
                            ->title('已更新 ' . $records->count() . ' 筆訂單狀態')
                            ->success()
                            ->send();
                    })
                    ->deselectRecordsAfterCompletion()
                    ->requiresConfirmation(),
            ])
            ->headerActions([
                Tables\Actions\Action::make('refresh')
                    ->label('刷新')
                    ->icon('heroicon-o-arrow-path')
                    ->color('gray')
                    ->action(function ($livewire) {
                        $livewire->dispatch('$refresh');
                    }),
                ActionGroup::make([
                    Tables\Actions\Action::make('export_all')
                        ->label('全部匯出')
                        ->icon('heroicon-o-document-text')
                        ->action('exportAll'),
                    Tables\Actions\Action::make('export_selected')
                        ->label('匯出選中')
                        ->icon('heroicon-o-check-circle')
                        ->accessSelectedRecords()
                        ->action(function ($livewire) {
                            return $livewire->exportSelected();
                        }),
                ])
                    ->label('匯出')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->button(),
            ]);
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function buildExportData($orders): array
    {
        $data = [];
        foreach ($orders as $item) {
            $productTxt = '';
            foreach ($item->products as $k => $vv) {
                $productTxt .= $vv->product_name . "({$vv->unit_price}/件)*{$vv->number}";
                if (($k + 1) < count($item->products)) {
                    $productTxt .= PHP_EOL;
                }
            }

            // Address format
            if ($item->delivery_type > 0) {
                $shopTypeName = isset(Order::SHOP_TYPE_TXT[$item->shop_type])
                    ? Order::SHOP_TYPE_TXT[$item->shop_type] : '超商';
                $addr = $item->address . "（{$shopTypeName}{$item->shop_name}門市{$item->shop_no}自取件）電話通知到店取貨";
            } else {
                // Time calculation for home delivery
                if ($item->delivery_time == 1) {
                    $gettime = '11:20:00';
                } elseif ($item->delivery_time == 2) {
                    $gettime = '14:35:00';
                } else {
                    $gettime = '18:50:00';
                }
                $parts = explode(':', $gettime);
                if ($parts[1] == '55') {
                    $parts[1] = '00';
                    $parts[0] = (int)$parts[0] + 1;
                } else {
                    $parts[1] = (int)$parts[1] + 5;
                }
                $updateGetTime = sprintf('%02d:%02d:00', $parts[0], $parts[1]);
                $addr = "{$item->city}{$item->county}{$item->street}{$item->address}-請於{$updateGetTime}前送達";
            }

            $deliveryTime = $item->delivery_time
                ? (Order::DELIVERY_TIME[$item->delivery_time] ?? '') : '';

            $data[] = [
                $item->no,
                $item->inside_no,
                $productTxt,
                $item->total_price,
                $item->name,
                $item->phone,
                $item->email,
                $addr,
                Order::DELIVERY_TYPE_TXT[$item->delivery_type] ?? '',
                $deliveryTime,
                $item->remarks,
                Order::STATUS_TXT[$item->status] ?? $item->status,
            ];
        }
        return $data;
    }
}
