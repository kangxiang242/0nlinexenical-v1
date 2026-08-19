<style>
    /* Sidebar width optimization - narrower sidebar, wider content（对齐 twshop-v1） */
    .fi-sidebar {
        width: 10.5rem !important;
    }

    /* 右侧内容区左右边距加大（对齐 twshop-v1） */
    .fi-main {
        padding-left: 3rem !important;
        padding-right: 3rem !important;
    }

    .fi-sidebar .fi-brand-logo-text {
        font-size: 0.8125rem !important;
    }

    .fi-sidebar .fi-sidebar-nav-item-label {
        font-size: 0.75rem !important;
    }

    .fi-sidebar .fi-icon {
        width: 1.125rem !important;
        height: 1.125rem !important;
    }

    .fi-sidebar .fi-sidebar-nav > ul > li {
        padding-inline: 0.25rem !important;
    }

    .fi-sidebar .fi-sidebar-nav-item {
        gap: 0.375rem !important;
        padding-block: 0.3125rem !important;
        padding-inline: 0.375rem !important;
    }

    /* 编辑/新增页：左标题、右编辑框 */
    .fi-resource-edit-record-page .fi-fo-field-wrp > .grid,
    .fi-resource-create-record-page .fi-fo-field-wrp > .grid {
        display: grid !important;
        grid-template-columns: 180px 1fr !important;
        gap: 12px !important;
        align-items: start !important;
    }
    .fi-resource-edit-record-page .fi-fo-field-wrp-label,
    .fi-resource-create-record-page .fi-fo-field-wrp-label {
        padding-top: 0 !important;
        margin-top: 8px !important;
        width: 100% !important;
        justify-content: flex-end !important;
    }
    .fi-resource-edit-record-page .fi-fo-field-wrp > .grid > div:first-child,
    .fi-resource-create-record-page .fi-fo-field-wrp > .grid > div:first-child {
        justify-content: flex-end !important;
    }

    /* FilePond 透明背景 */
    .filepond--image-preview {
        background-color: transparent !important;
    }
    .filepond--image-preview-overlay-idle {
        mix-blend-mode: normal !important;
        opacity: 0 !important;
    }
    .filepond--panel.filepond--item-panel,
    .filepond--item-panel {
        background: transparent !important;
    }
    .filepond--panel-top,
    .filepond--panel-bottom,
    .filepond--panel-center {
        display: none !important;
    }

    /* 表格全局左对齐 */
    .fi-ta-table th,
    .fi-ta-table td {
        text-align: left !important;
    }

    /* 收貨人信息列修复 */
    .fi-ta-text-item {
        display: block !important;
    }
</style>