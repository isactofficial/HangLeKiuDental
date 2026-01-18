<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier - hanglekiu dental specialist</title>
    <style>
        /* Hamburger Menu (matching Dashboard) */
        .hamburger {
            display: none;
            background: var(--surface);
            border: none;
            padding: 0;
            cursor: pointer;
            justify-content: center;
            align-items: center;
            height: 36px;
            width: 36px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 1001;
        }

        .hamburger-bar {
            display: block;
            width: 20px;
            height: 3px;
            background: var(--accent);
            margin: 3px 0;
            border-radius: 2px;
            transition: all 0.3s;
        }

        .hamburger i {
            color: var(--accent);
            font-size: 16px;
        }

        @media (max-width: 900px) {
            .hamburger {
                display: flex;
                position: static;
                margin-right: 8px;
                flex: 0 0 auto;
                align-self: center;
            }

            .cashier-header {
                position: static;
                padding-left: 12px;
                padding-right: 12px;
                min-height: auto;
                align-items: center;
            }

            .kasir-title {
                margin-left: 0;
                flex: 1 1 auto;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .header-actions {
                margin-left: 0;
                min-width: 0;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--main-bg);
            color: var(--text);
            min-height: 100vh;
            display: flex
        }

        .main {
            margin-left: 60px;
            flex: 1;
            padding: 0 12px
        }

        .cashier-header {
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            background: var(--surface);
            flex-wrap: wrap;
        }

        .cashier-header .kasir-title {
            display: flex;
            flex-direction: column;
            gap: 2px;
            min-width: 220px
        }

        .cashier-header .kasir-title-main {
            font-size: 26px;
            line-height: 1.1;
            font-weight: 700;
            color: #B08D70
        }

        .cashier-header .kasir-title-sub {
            font-size: 14px;
            color: #5F6F65;
            opacity: 1
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: auto;
            flex: 0 0 auto;
            min-width: 0
        }

        .header-hd {
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            min-width: 0
        }

        .header-logo {
            width: 44px;
            height: 44px;
            border-radius: 22px;
            background: #e6eef6;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto
        }

        .header-logo img {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .header-dropdown-btn {
            background: var(--action);
            color: #fff;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
            max-width: 160px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            position: relative;
            cursor: pointer;
        }

        .header-dropdown-btn i {
            margin-left: 6px;
        }

        /* Profile pill variant (avatar + name inside rounded pill) — match dashboard `.user-dropdown` */
        .header-dropdown-btn.profile-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--action);
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
            color: #fff;
            font-weight: 600
        }

        .header-dropdown-btn.profile-pill .pill-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            overflow: hidden;
            flex: 0 0 auto;
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: center
        }

        .header-dropdown-btn.profile-pill .pill-avatar img {
            width: 26px;
            height: 26px;
            object-fit: cover;
            border-radius: 50%
        }

        .header-dropdown-btn.profile-pill .pill-name {
            font-weight: 600;
            color: #fff;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px
        }

        .header-dropdown-container {
            position: relative
        }

        .header-dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 8px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            min-width: 180px;
            display: none;
            z-index: 1000;
            overflow: hidden
        }

        .header-dropdown-menu.show {
            display: block
        }

        .header-dropdown-menu a,
        .header-dropdown-menu form button {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 12px 16px;
            color: #374151;
            text-decoration: none;
            background: none;
            border: none;
            text-align: left;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.15s
        }

        .header-dropdown-menu a:hover,
        .header-dropdown-menu form button:hover {
            background: #f3f4f6
        }

        .header-dropdown-menu .logout {
            color: #dc2626;
            border-top: 1px solid #f3f4f6
        }

        .header-actions .icon-btn {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            font-size: 20px;
            color: #888;
            transition: color 0.2s
        }

        .header-actions .icon-btn:hover {
            color: #2196f3
        }

        .header-actions .profile-btn {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            font-size: 22px;
            color: #888;
            transition: color 0.2s
        }

        .header-actions .profile-btn:hover {
            color: #2196f3
        }

        .cashier-content {
            padding: 36px 0 0 0;
            min-height: 60vh;
            display: flex;
            gap: 24px
        }

        .cashier-sidebar {
            width: 200px;
            background: var(--surface);
            border-radius: 8px;
            padding: 0;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03);
            height: fit-content;
            overflow: hidden
        }

        .cashier-sidebar .tab {
            padding: 16px 18px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            outline: none;
            text-align: left;
            width: 100%;
            background: #fff;
            color: #222;
            border-bottom: 1px solid #e5e7eb;
            transition: background 0.2s;
            border-radius: 0
        }

        .cashier-sidebar .tab.active {
            background: #B08D70;
            color: #fff;
            border-radius: 0;
        }

        .cashier-sidebar .tab:last-child {
            border-bottom: none
        }

        .cashier-main {
            flex: 1;
        }

        .filter-box {
            background: var(--surface);
            padding: 22px 22px 18px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 22px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03)
        }

        .toolbar-row {
            display: flex;
            gap: 18px;
            align-items: center;
            flex-wrap: wrap
        }

        .search-wrap {
            position: relative;
            flex: 1 1 520px;
            min-width: 320px
        }

        .search-wrap input {
            width: 100%;
            height: 44px;
            padding: 10px 46px 10px 16px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            font-size: 14px;
            outline: none
        }

        .search-wrap .search-icon-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #111827;
            cursor: pointer;
            font-size: 16px;
            padding: 6px;
            line-height: 1
        }

        .search-wrap.no-icon input {
            padding-right: 16px
        }

        .action-btns {
            display: flex;
            gap: 14px;
            flex: 0 0 auto;
            flex-wrap: wrap
        }

        .action-btns button {
            height: 44px;
            padding: 0 18px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            min-width: 160px;
            box-shadow: 1px 2px 6px #e5e7eb;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px
        }

        .action-btns button:disabled,
        .action-btns button[aria-disabled="true"] {
            opacity: .6;
            cursor: not-allowed;
            box-shadow: none;
        }

        .action-btns .add {
            background: var(--action);
            color: #fff
        }

        .action-btns .export {
            background: var(--action);
            color: #fff
        }

        .filter-row {
            display: flex;
            gap: 34px;
            align-items: flex-end;
            flex-wrap: wrap
        }

        .filter-field {
            min-width: 170px
        }

        .filter-row label {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 8px;
            display: block
        }

        .filter-row input[type="date"] {
            width: 100%;
            height: 36px;
            padding: 6px 0;
            border: none;
            border-bottom: 1px solid #9ca3af;
            border-radius: 0;
            background: transparent;
            outline: none
        }

        .filter-row select {
            width: 100%;
            height: 36px;
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #fff;
            outline: none
        }

        .filter-btn {
            height: 40px;
            background: #e5e7eb;
            color: #111827;
            padding: 0 18px;
            border-radius: 8px;
            border: none;
            font-weight: 700;
            box-shadow: 1px 2px 6px #e5e7eb;
            cursor: pointer
        }

        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 18px;
            font-size: 14px;
            color: #64748b;
            gap: 16px;
            flex-wrap: wrap
        }

        .table-footer select {
            border: none;
            background: transparent;
            color: #B08D70;
            font-weight: 500;
            outline: none
        }

        .table-footer .pager {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .table-footer button {
            background: none;
            border: none;
            color: #bdbdbd;
            font-size: 18px;
            cursor: pointer;
            padding: 4px 6px;
        }

        .table-footer button:disabled {
            cursor: not-allowed;
            opacity: .9
        }

        .table-responsive {
            background: #fff;
            border-radius: 8px;
            overflow-x: auto;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03)
        }

        table {
            width: 100%;
            border-collapse: collapse
        }

        th,
        td {
            padding: 14px 10px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top
        }

        th {
            background: #f1f5f9;
            color: #334155;
            font-size: 16px;
            font-weight: 600
        }

        .empty-row {
            color: #64748b;
            text-align: center
        }

        /* Additional styles for table data display */
        .detail-item {
            display: flex;
            gap: 8px;
            margin-bottom: 6px;
            font-size: 14px;
            align-items: flex-start
        }

        .detail-label {
            color: #64748b;
            min-width: 100px;
            flex-shrink: 0
        }

        .detail-value {
            color: #111827;
            font-weight: 500;
            line-height: 1.4
        }

        .action-cell {
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: flex-start
        }

        .btn-bayar {
            background: #B08D70;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            min-width: 80px;
            transition: background 0.2s
        }

        .btn-bayar.is-paid {
            background: #16a34a;
        }

        .btn-bayar.is-paid:hover {
            background: #15803d;
        }

        .btn-bayar.is-partial {
            background: #f59e0b;
        }

        .btn-bayar.is-partial:hover {
            background: #d97706;
        }

        .btn-bayar:disabled,
        .btn-bayar[aria-disabled="true"] {
            background: #9ca3af;
            opacity: 0.75;
            cursor: not-allowed;
        }

        .btn-bayar:disabled:hover,
        .btn-bayar[aria-disabled="true"]:hover {
            background: #9ca3af;
        }

        .btn-bayar:hover {
            background: #774318
        }

        .sound-icon {
            color: #B08D70;
            font-size: 18px;
            cursor: pointer;
            margin-top: 4px;
            transition: color 0.2s
        }

        .sound-icon:hover {
            color: #774318
        }

        @media (max-width: 1100px) {
            .cashier-content {
                flex-direction: column;
                gap: 12px
            }

            .cashier-sidebar {
                width: 100%;
                display: flex;
                flex-direction: row;
                gap: 0;
                box-shadow: none;
                margin-bottom: 12px
            }

            .cashier-sidebar .tab {
                flex: 1;
                text-align: center;
                border-radius: 6px 6px 0 0;
            }
        }

        @media (max-width: 900px) {
            .main {
                margin-left: 0;
                padding: 0 6px
            }

            /* keep header items in a responsive row where possible */
            .cashier-header {
                flex-direction: row;
                align-items: center;
                gap: 8px;
                padding: 10px;
            }

            .hamburger {
                display: flex;
                position: static;
                order: 1;
                margin-right: 8px
            }

            .kasir-title {
                order: 2;
                margin-left: 8px;
                flex: 0 0 auto;
                white-space: nowrap
            }

            .header-actions {
                order: 3;
                margin-left: auto;
                gap: 8px;
                min-width: 0
            }

            .header-actions .header-hd {
                display: flex;
                align-items: center;
                gap: 8px;
                min-width: 0
            }

            .cashier-content {
                padding: 16px 0 0 0;
            }
        }

        @media (max-width: 600px) {
            .cashier-header {
                flex-direction: row;
                align-items: center;
                gap: 6px;
                padding: 10px 8px;
            }

            .hamburger {
                order: 1;
                margin-right: 6px;
                width: 32px;
                height: 32px
            }

            .hamburger i {
                font-size: 14px
            }

            .kasir-title {
                order: 2;
                margin-left: 0;
                flex: 1 1 auto;
                min-width: 0
            }

            .kasir-title-main {
                font-size: 18px !important;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis
            }

            .kasir-title-sub {
                font-size: 11px !important;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis
            }

            .header-actions {
                order: 3;
                gap: 6px;
                flex-shrink: 0
            }

            .header-actions .icon-btn {
                font-size: 16px
            }

            .header-actions .profile-btn {
                font-size: 18px
            }

            .header-logo {
                width: 28px;
                height: 28px
            }

            .header-logo img {
                width: 20px;
                height: 20px
            }

            .header-dropdown-btn.profile-pill {
                padding: 6px 10px;
                font-size: 12px;
                gap: 6px
            }

            .header-dropdown-btn.profile-pill .pill-avatar {
                width: 24px;
                height: 24px
            }

            .header-dropdown-btn.profile-pill .pill-avatar img {
                width: 20px;
                height: 20px
            }

            .header-dropdown-btn.profile-pill .pill-name {
                font-size: 12px
            }

            .cashier-sidebar .tab {
                padding: 10px 6px;
                font-size: 13px
            }

            .filter-box {
                padding: 12px 10px
            }

            .search-wrap {
                min-width: 100%;
                flex: 1 1 100%
            }

            .search-wrap.no-icon {
                min-width: 100%;
                flex: 1 1 100%
            }

            .action-btns {
                width: 100%;
                gap: 8px
            }

            .action-btns button {
                flex: 1;
                min-width: 0;
                font-size: 12px;
                padding: 0 10px;
                height: 38px
            }

            .filter-row {
                gap: 12px
            }

            .filter-field {
                min-width: 130px;
                flex: 1 1 45%
            }

            .filter-row input[type="date"] {
                padding: 6px 0;
                font-size: 12px
            }

            .filter-row input[type="text"] {
                font-size: 12px
            }

            .filter-btn {
                font-size: 12px;
                padding: 0 14px;
                height: 36px;
                width: 100%;
                margin-top: 8px
            }

            /* Table mobile optimization */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch
            }

            th,
            td {
                padding: 10px 6px;
                font-size: 11px
            }

            th {
                font-size: 12px
            }

            .detail-item {
                font-size: 11px;
                margin-bottom: 4px;
                flex-direction: column;
                gap: 2px
            }

            .detail-label {
                min-width: auto;
                font-size: 10px;
                color: #94a3b8
            }

            .detail-value {
                font-size: 11px;
                line-height: 1.3
            }

            .btn-bayar {
                padding: 6px 12px;
                font-size: 11px;
                min-width: 60px
            }

            .sound-icon {
                font-size: 14px;
                margin-top: 2px
            }

            .action-cell {
                gap: 6px
            }

            /* Compact table cells on mobile */
            td:first-child {
                min-width: 90px
            }

            td:nth-child(2) {
                min-width: 100px
            }

            td:nth-child(3) {
                min-width: 180px
            }

            td:nth-child(4) {
                min-width: 80px
            }

            td:nth-child(5) {
                min-width: 80px
            }
        }

        @media (max-width: 400px) {
            .kasir-title-main {
                font-size: 16px !important
            }

            .kasir-title-sub {
                font-size: 10px !important
            }

            .header-dropdown-btn.profile-pill .pill-name {
                max-width: 60px;
                overflow: hidden;
                text-overflow: ellipsis
            }

            .detail-value {
                font-size: 10px
            }

            .btn-bayar {
                font-size: 10px;
                padding: 5px 10px
            }

            .filter-field {
                min-width: 110px
            }
        }

        /* --- Tambahan Style untuk Modal Pembayaran --- */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal-content {
            background: #fff;
            width: 100%;
            max-width: 1100px;
            height: 90vh;
            /* Fixed height for scrollability */
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 20px 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            border-bottom: 1px solid #eee;
        }

        .modal-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: #B08D70;;
            margin: 0;
        }

        .modal-close {
            position: absolute;
            right: 24px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 24px;
            color: #999;
            cursor: pointer;
        }

        .modal-scroll-body {
            flex: 1;
            overflow-y: auto;
            padding: 0 0 20px 0;
        }

        .section-blue-header {
            background-color: #B08D70;;
            color: #fff;
            padding: 10px 24px;
            font-weight: 500;
            font-size: 14px;
            margin-top: 0;
        }

        .section-content {
            padding: 20px 24px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .search-line {
            position: relative;
            width: 100%;
        }

        .search-line input {
            width: 100%;
            border: none;
            border-bottom: 1px solid #ddd;
            padding: 10px 10px 10px 30px;
            outline: none;
            font-size: 14px;
        }

        .search-line i {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        /* Review Section */
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .review-title h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .review-title p {
            margin: 4px 0 0;
            font-size: 12px;
            color: #666;
        }

        .review-controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .review-controls select,
        .review-controls input {
            height: 36px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 0 10px;
            font-size: 13px;
        }

        .review-table-wrap {
            border-bottom: 1px solid #B08D70;;
            margin-bottom: 10px;
        }

        .review-table th {
            background: #fff;
            color: #B08D70;;
            border-bottom: 1px solid #eee;
            font-weight: 500;
            font-size: 13px;
        }

        .review-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;
            font-weight: 600;
        }

        .print-link {
            color: #B08D70;;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        /* Payment Methods Grid */
        .payment-method-row {
            margin-bottom: 15px;
        }

        .full-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #B08D70;;
            border-radius: 4px;
            color: #B08D70;;
            background: #fff;
            outline: none;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 15px;
        }

        .payment-input-group label {
            display: block;
            font-size: 12px;
            color: #B08D70;;
            margin-bottom: 5px;
        }

        .payment-input-group label span {
            color: red;
        }

        .input-underline-only {
            width: 100%;
            border: none;
            border-bottom: 1px solid #ccc;
            padding: 8px 0;
            font-size: 14px;
            outline: none;
        }

        .input-bg-grey {
            background: #eee;
            padding-left: 10px;
        }

        .modal-footer-action {
            padding: 20px 24px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-pay-modal {
            background: #e0e0e0;
            color: #999;
            border: none;
            padding: 10px 30px;
            border-radius: 4px;
            font-weight: 600;
            cursor: default;
        }

        .btn-pay-modal.active {
            background: #B08D70;;
            color: white;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .payment-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .review-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .modal-content {
                height: 100%;
                border-radius: 0;
            }
        }
    </style>
</head>

<body>
    @include('partials.sidebar')
    <div class="sidebar-backdrop" id="sidebarBackdrop" style="display:none;"></div>
    <div class="main">
        <div class="cashier-header">
            <button id="sidebarToggle" class="hamburger" onclick="toggleSidebar()" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
            <div class="kasir-title">
                <div class="kasir-title-main">Cashier</div>
                <div class="kasir-title-sub">hanglekiu dental specialist</div>
            </div>
            <div class="header-actions">
                <div class="header-hd">
                    <button class="header-dropdown-btn profile-pill" id="hdDropdownBtn" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="pill-avatar">
                            <img src="https://ui-avatars.com/api/?name=Wildan&background=e6eef6&color=B08D70&size=64&rounded=true"
                                alt="avatar">
                        </span>
                        <span class="pill-name">Wildan <i class="fas fa-chevron-down"></i></span>
                    </button>
                    <div class="header-dropdown-menu" id="hdDropdownMenu">
                        <a href="/profile"><i class="fas fa-user" style="margin-right:8px;"></i> Profil</a>
                        <form action="{{ route('logout') }}" method="POST" style="display:block;">
                            @csrf
                            <button type="submit" class="logout"><i class="fas fa-sign-out-alt"
                                    style="margin-right:8px;"></i> Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="cashier-content">
            <div class="cashier-sidebar">
                <button class="tab active">Pembayaran</button>
                <button class="tab">Hutang & Piutang</button>
            </div>
            <div class="cashier-main">
                <div id="pembayaran-section">
                    <div class="filter-box">
                        <div class="toolbar-row">
                            <form class="search-wrap" method="GET" action="{{ route('cashier') }}">
                                <input type="hidden" name="date_from" value="{{ $dateFrom ?? now()->toDateString() }}">
                                <input type="hidden" name="date_to" value="{{ $dateTo ?? now()->toDateString() }}">
                                <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Cari nama pasien, dokter atau invoice">
                                <button type="submit" class="search-icon-btn" aria-label="Search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                            <div class="action-btns">
                                <button class="add" id="addBtn" type="button" title="Fitur ini belum aktif">
                                    <i class="fas fa-plus"></i> Pembayaran
                                </button>
                                <button class="export" id="exportBtn" type="button" data-export-base="{{ route('cashier.export') }}"><i class="fas fa-file-export"></i> Export</button>
                            </div>
                        </div>

                        <form class="filter-row" method="GET" action="{{ route('cashier') }}">
                            <input type="hidden" name="q" value="{{ $q ?? '' }}">
                            <div class="filter-field">
                                <label for="from_date">Dari Tanggal</label>
                                <input type="date" id="from_date" name="date_from" value="{{ $dateFrom ?? now()->toDateString() }}">
                            </div>
                            <div class="filter-field">
                                <label for="to_date">Sampai Tanggal</label>
                                <input type="date" id="to_date" name="date_to" value="{{ $dateTo ?? now()->toDateString() }}">
                            </div>
                            <button type="submit" class="filter-btn">FILTER</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width:140px">Tanggal</th>
                                    <th style="width:120px">Invoice</th>
                                    <th>Nama Lengkap Pasien</th>
                                    <th>Keterangan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($appointments ?? collect()) as $a)
                                    <tr>
                                        <td>
                                            <div style="font-weight:600;color:#111827">
                                                {{ \Carbon\Carbon::parse($a->start_at)->format('d/m/Y') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div style="font-weight:600;color:#111827">
                                                {{ $a->code ?: ('INV' . str_pad((string)$a->id, 6, '0', STR_PAD_LEFT)) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div style="font-weight:600;color:#111827">{{ $a->patient_name }}</div>
                                        </td>
                                        <td>
                                            <div class="detail-item">
                                                <span class="detail-label">Tenaga Medis</span>
                                                <span class="detail-value">{{ optional($a->doctor)->name ?? '-' }}</span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label">Tindakan</span>
                                                <span class="detail-value">{{ $a->procedure ?: '-' }}</span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label">Metode Bayar</span>
                                                <span class="detail-value">{{ $a->payment_method ?: '-' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-cell">
                                                @php
                                                    $paymentStatus = strtolower((string) ($a->payment_status ?? 'unpaid'));
                                                    $isPaid = $paymentStatus === 'paid';
                                                    $payLabel = $isPaid ? 'Lunas' : ($paymentStatus === 'partial' ? 'Bayar (Sisa)' : 'Bayar');
                                                    $payClass = $isPaid ? 'is-paid' : ($paymentStatus === 'partial' ? 'is-partial' : '');
                                                @endphp
                                                <button class="btn-bayar {{ $payClass }}" type="button" data-invoice-url="{{ route('cashier.invoice', $a) }}">{{ $payLabel }}</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="empty-row">Tidak ada data yang bisa ditampilkan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer">
                        <div>
                            Jumlah baris per halaman:
                            <select
                                style="border:none;background:transparent;color:#B08D70;font-weight:500;outline:none;">
                                <option>5</option>
                                <option>10</option>
                                <option>20</option>
                            </select>
                        </div>
                        <div>1-2 dari 2 data</div>
                        <div class="pager">
                            <button disabled>&lt;|</button>
                            <button disabled>&lt;</button>
                            <button disabled>&gt;</button>
                            <button disabled>|&gt;</button>
                        </div>
                    </div>
                </div>
                <div id="hutang-section" style="display:none;">
                    <div class="filter-box">
                        <div class="filter-row">
                            <div class="filter-field">
                                <label for="from_date_hutang">Dari Tanggal</label>
                                <input type="date" id="from_date_hutang" value="2025-12-01">
                            </div>
                            <div class="filter-field">
                                <label for="to_date_hutang">Sampai Tanggal</label>
                                <input type="date" id="to_date_hutang" value="2025-12-31">
                            </div>
                            <div class="filter-field" style="min-width:140px">
                                <label for="tipe_hutang">Tipe *</label>
                                <select id="tipe_hutang">
                                    <option>Semua</option>
                                    <option>Pasien</option>
                                    <option>Distributor</option>
                                </select>
                            </div>
                        </div>

                        <div class="toolbar-row">
                            <div class="search-wrap no-icon">
                                <input type="text"
                                    placeholder="Cari nama pasien, nama distributor atau nomor invoice">
                            </div>
                        </div>

                        <div style="display:flex;justify-content:flex-start;">
                            <button type="button" class="filter-btn"
                                onclick="alert('Filter hutang diklik!')">FILTER</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="empty-row">Tidak ada data yang bisa ditampilkan.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer">
                        <div>
                            Jumlah baris per halaman:
                            <select
                                style="border:none;background:transparent;color:#B08D70;font-weight:500;outline:none;">
                                <option>5</option>
                                <option>10</option>
                                <option>20</option>
                            </select>
                        </div>
                        <div>0-0 dari 0 data</div>
                        <div class="pager">
                            <button disabled>&lt;|</button>
                            <button disabled>&lt;</button>
                            <button disabled>&gt;</button>
                            <button disabled>|&gt;</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalPembayaran" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Pembayaran</h2>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>

            <div class="modal-scroll-body">
                <div class="section-blue-header">Buat Invoice</div>
                <div class="section-content">
                    <div style="display:grid;grid-template-columns:1fr;gap:12px">
                        <div>
                            <div style="font-size:12px;color:#64748b;margin-bottom:6px">Cari Pasien / Kode / BK</div>
                            <div class="search-line">
                                <i class="fas fa-search"></i>
                                <input id="createApptSearch" type="text" placeholder="Contoh: BK000123 / nama pasien / kode" autocomplete="off">
                            </div>
                        </div>
                        <div id="createApptResults" style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;display:none"></div>
                        <div style="display:grid;grid-template-columns:2fr 90px 140px 120px;gap:12px;align-items:end">
                            <div>
                                <div style="font-size:12px;color:#64748b;margin-bottom:6px">Tindakan (opsional)</div>
                                <select id="createProcedure" class="full-select" style="padding:10px">
                                    <option value="">-- Pilih dari katalog (opsional) --</option>
                                    @foreach(($procedures ?? collect()) as $p)
                                        <option value="{{ $p->id }}" data-name="{{ $p->name }}" data-price="{{ (int) $p->price }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <div style="font-size:12px;color:#64748b;margin-bottom:6px">Qty</div>
                                <input id="createQty" type="number" min="1" value="1" class="input-underline-only" style="padding:8px 0">
                            </div>
                            <div>
                                <div style="font-size:12px;color:#64748b;margin-bottom:6px">Harga</div>
                                <input id="createPrice" type="number" min="0" value="0" class="input-underline-only" style="padding:8px 0">
                            </div>
                            <div>
                                <div style="font-size:12px;color:#64748b;margin-bottom:6px">Diskon</div>
                                <input id="createDiscount" type="number" min="0" value="0" class="input-underline-only" style="padding:8px 0">
                            </div>
                        </div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;align-items:end">
                            <div>
                                <div style="font-size:12px;color:#64748b;margin-bottom:6px">Nama Item (wajib)</div>
                                <input id="createName" type="text" class="input-underline-only" placeholder="Contoh: Scaling / Tambal gigi" style="padding:8px 0">
                            </div>
                            <div style="display:flex;justify-content:flex-end">
                                <button id="createAddItemBtn" type="button" class="filter-btn" style="height:40px">TAMBAH ITEM</button>
                            </div>
                        </div>
                        <div id="createHint" style="font-size:12px;color:#64748b">Klik <b>+ Pembayaran</b> lalu cari pasien untuk mulai buat invoice.</div>
                    </div>
                </div>

                <div class="section-blue-header">Detail Pasien</div>
                <div class="section-content">
                    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:14px;align-items:start">
                        <div>
                            <div style="font-size:12px;color:#64748b;margin-bottom:6px">Nama Lengkap</div>
                            <div id="invPatientName" style="font-weight:600;color:#111827">-</div>
                        </div>
                        <div>
                            <div style="font-size:12px;color:#64748b;margin-bottom:6px">ID</div>
                            <div id="invPatientMr" style="font-weight:600;color:#111827">-</div>
                        </div>
                        <div>
                            <div style="font-size:12px;color:#64748b;margin-bottom:6px">Usia</div>
                            <div id="invPatientAge" style="font-weight:600;color:#111827">-</div>
                        </div>
                        <div>
                            <div style="font-size:12px;color:#64748b;margin-bottom:6px">Nomor HP / Whatsapp</div>
                            <div id="invPatientPhone" style="font-weight:600;color:#111827">-</div>
                        </div>
                        <div>
                            <div style="font-size:12px;color:#64748b;margin-bottom:6px">Nama Dokter</div>
                            <div id="invDoctorName" style="font-weight:600;color:#111827">-</div>
                        </div>
                    </div>
                </div>

                <div class="section-blue-header">Review</div>
                <div class="section-content">
                    <div class="review-header">
                        <div class="review-title">
                            <h3>INVOICE</h3>
                            <p style="margin-top:6px">
                                <span style="color:#64748b">Nomor:</span>
                                <strong id="invCode" style="color:#111827">-</strong>
                                <a href="#" id="invEditToggle" style="margin-left:8px;color:#dc2626;text-decoration:none;font-weight:600">edit</a>
                                <span style="margin:0 10px;color:#e5e7eb">|</span>
                                <span style="color:#64748b">Tanggal:</span>
                                <strong id="invDate" style="color:#111827">-</strong>
                            </p>
                        </div>
                    </div>

                    <div class="table-responsive review-table-wrap">
                        <table class="review-table">
                            <thead>
                                <tr>
                                    <th style="width:160px">Tanggal Input</th>
                                    <th>Tindakan / Obat / Bahan Habis Pakai</th>
                                    <th style="width:90px">Jumlah</th>
                                    <th style="width:140px">Harga</th>
                                    <th style="width:120px">Diskon</th>
                                    <th style="width:160px">Total</th>
                                </tr>
                            </thead>
                            <tbody id="invoiceItemsBody"></tbody>
                        </table>
                    </div>
                    <div class="review-footer">
                        <span>Total : &nbsp; <strong id="invoiceTotal">Rp0</strong></span>
                        <a href="#" class="print-link">PRINT</a>
                    </div>
                </div>

                <div class="section-blue-header">Metode Pembayaran</div>
                <div class="section-content">
                    <div style="margin-bottom:15px;">
                        <input type="checkbox" id="multiPay"> <label for="multiPay"
                            style="font-size:13px; color:#333;">Multi type payment</label>
                    </div>

                    <div style="margin-bottom:15px;">
                        <label style="font-size:12px; color:#B08D70;; display:block; margin-bottom:4px;">Metode
                            Pembayaran</label>
                        <select id="paymentMethodSelect" class="full-select">
                            <option value="Langsung">Langsung</option>
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer">Transfer</option>
                            <option value="QRIS">QRIS</option>
                            <option value="Kartu">Kartu</option>
                            <option value="BPJS">BPJS</option>
                        </select>
                    </div>

                    <div class="payment-grid"
                        style="margin-bottom:15px; grid-template-columns: 1fr 1fr; align-items:end;">
                        <div
                            style="border: 1px solid #ddd; padding: 5px; border-radius:4px; display:flex; justify-content:space-between; align-items:center;">
                            <span>Tunai</span>
                            <i class="fas fa-times" style="color:#999; cursor:pointer;"></i>
                        </div>
                        <div></div>
                    </div>

                    <div style="margin-bottom:20px;">
                        <label style="font-size:12px; color:#666;">Akun</label>
                        <select
                            style="width:100%; border:none; border-bottom:1px solid #ccc; padding:8px 0; outline:none;">
                            <option>Kas</option>
                        </select>
                    </div>

                    <div class="payment-grid">
                        <div class="payment-input-group">
                            <label>Bayar <span>*</span></label>
                            <input id="payAmount" type="number" min="0" step="1" class="input-underline-only" placeholder="0">
                        </div>
                        <div class="payment-input-group">
                            <label>Dibayar Oleh <span>*</span></label>
                            <input id="paidByName" type="text" class="input-underline-only" placeholder="Nama pembayar">
                        </div>
                        <div class="payment-input-group">
                            <label style="color:#999;">Kembalian (Rp)</label>
                            <input id="payChange" type="text" class="input-underline-only input-bg-grey" placeholder="Rp0" readonly>
                        </div>
                        <div class="payment-input-group">
                            <label style="color:#999;">Hutang</label>
                            <input id="payDebt" type="text" class="input-underline-only input-bg-grey" placeholder="Rp0" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer-action">
                <button id="paySubmitBtn" type="button" class="btn-pay-modal" disabled>Bayar</button>
            </div>
        </div>
    </div>
    <script>
        // Dropdown logic — toggle `.show` and aria-expanded for accessibility
        const hdDropdownBtn = document.getElementById('hdDropdownBtn');
        const hdDropdownMenu = document.getElementById('hdDropdownMenu');
        if (hdDropdownBtn && hdDropdownMenu) {
            document.addEventListener('click', function(e) {
                if (hdDropdownBtn.contains(e.target)) {
                    const isOpen = hdDropdownMenu.classList.contains('show');
                    if (isOpen) {
                        hdDropdownMenu.classList.remove('show');
                        hdDropdownMenu.style.display = 'none';
                        hdDropdownBtn.setAttribute('aria-expanded', 'false');
                    } else {
                        hdDropdownMenu.classList.add('show');
                        hdDropdownMenu.style.display = 'block';
                        hdDropdownBtn.setAttribute('aria-expanded', 'true');
                    }
                } else if (!hdDropdownMenu.contains(e.target)) {
                    hdDropdownMenu.classList.remove('show');
                    hdDropdownMenu.style.display = 'none';
                    hdDropdownBtn.setAttribute('aria-expanded', 'false');
                }
            });
        }

        function toggleSidebar() {
            document.getElementById('appSidebar').classList.toggle('open');
            var backdrop = document.getElementById('sidebarBackdrop');
            if (backdrop) backdrop.style.display = backdrop.style.display === 'block' ? 'none' : 'block';
        }
        document.addEventListener('DOMContentLoaded', function() {
            var backdrop = document.getElementById('sidebarBackdrop');
            if (backdrop) {
                backdrop.addEventListener('click', toggleSidebar);
            }
        });
        const csrfToken = (document.querySelector('meta[name="csrf-token"]') || {}).content;
        const invoiceBaseUrl = @json(url('/cashier/appointments'));
        const searchApptUrl = @json(route('cashier.appointments.search'));
        const payUrlBase = @json(url('/cashier/appointments'));
        const itemUrlBase = @json(url('/cashier/items'));
        const paymentMethodUrlBase = @json(url('/cashier/appointments'));

        let currentAppointmentId = null;
        let currentInvoiceTotal = 0;
        let currentPaymentStatus = 'unpaid';
        let currentInvoiceData = null;
        let invoiceEditMode = false;

        function setCurrentAppointment(id) {
            currentAppointmentId = id ? Number(id) : null;
        }

        function setInvoiceTotal(total) {
            const n = Number(total || 0);
            currentInvoiceTotal = Number.isFinite(n) && n > 0 ? Math.trunc(n) : 0;
        }

        function setPaymentStatus(status) {
            const s = String(status || '').toLowerCase();
            currentPaymentStatus = s || 'unpaid';
        }

        async function loadInvoiceByAppointmentId(appointmentId) {
            const url = invoiceBaseUrl + '/' + appointmentId + '/invoice';
            const res = await fetch(url, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            if (!res.ok) throw new Error('Gagal memuat invoice');
            const data = await res.json();
            setCurrentAppointment(data && data.appointment ? data.appointment.id : appointmentId);
            renderInvoice(data);
        }

        // Button click handlers
        document.getElementById('addBtn').onclick = async function() {
            openModal();
            const input = document.getElementById('createApptSearch');
            if (input) {
                input.value = '';
                input.focus();
            }
            // clear invoice display until user selects appointment
            renderInvoice({ appointment: {}, items: [], total: 0 });
            setCurrentAppointment(null);
            resetPaymentForm();
        };
        document.getElementById('exportBtn').onclick = function() {
            const btn = document.getElementById('exportBtn');
            const base = btn ? btn.getAttribute('data-export-base') : null;
            if (!base) {
                alert('URL export tidak ditemukan');
                return;
            }

            const qInput = document.querySelector('form.search-wrap input[name="q"]');
            const fromInput = document.getElementById('from_date');
            const toInput = document.getElementById('to_date');

            const params = new URLSearchParams();
            const q = qInput ? String(qInput.value || '').trim() : '';
            const dateFrom = fromInput ? String(fromInput.value || '').trim() : '';
            const dateTo = toInput ? String(toInput.value || '').trim() : '';
            if (q) params.set('q', q);
            if (dateFrom) params.set('date_from', dateFrom);
            if (dateTo) params.set('date_to', dateTo);

            const url = params.toString() ? (base + '?' + params.toString()) : base;
            window.location.href = url;
        };

        // --- Invoice modal helpers ---
        const modal = document.getElementById('modalPembayaran');
        const invEls = {
            patientName: document.getElementById('invPatientName'),
            patientMr: document.getElementById('invPatientMr'),
            patientAge: document.getElementById('invPatientAge'),
            patientPhone: document.getElementById('invPatientPhone'),
            doctorName: document.getElementById('invDoctorName'),
            code: document.getElementById('invCode'),
            date: document.getElementById('invDate'),
            editToggle: document.getElementById('invEditToggle'),
            itemsBody: document.getElementById('invoiceItemsBody'),
            total: document.getElementById('invoiceTotal'),
        };

        const payEls = {
            amount: document.getElementById('payAmount'),
            paidBy: document.getElementById('paidByName'),
            change: document.getElementById('payChange'),
            debt: document.getElementById('payDebt'),
            submit: document.getElementById('paySubmitBtn'),
            method: document.getElementById('paymentMethodSelect'),
        };

        function safeInt(v, fallback = 0) {
            const n = Number(v);
            return Number.isFinite(n) ? Math.trunc(n) : fallback;
        }

        async function patchInvoiceItem(itemId, payload) {
            const url = itemUrlBase + '/' + itemId;
            const res = await fetch(url, {
                method: 'PATCH',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                },
                body: JSON.stringify(payload || {})
            });
            if (!res.ok) {
                let msg = 'Gagal mengubah item invoice';
                try {
                    const j = await res.json();
                    if (j && j.message) msg = j.message;
                } catch (e) {}
                throw new Error(msg);
            }
            return await res.json();
        }

        async function deleteInvoiceItem(itemId) {
            const url = itemUrlBase + '/' + itemId;
            const res = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                }
            });
            if (!res.ok) {
                let msg = 'Gagal menghapus item invoice';
                try {
                    const j = await res.json();
                    if (j && j.message) msg = j.message;
                } catch (e) {}
                throw new Error(msg);
            }
            return await res.json();
        }

        async function savePaymentMethod(method) {
            if (!currentAppointmentId) return;
            const url = paymentMethodUrlBase + '/' + currentAppointmentId + '/payment-method';
            const res = await fetch(url, {
                method: 'PATCH',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                },
                body: JSON.stringify({ payment_method: String(method || '') })
            });
            if (!res.ok) {
                // don't hard-fail UI; just inform
                let msg = 'Gagal menyimpan metode pembayaran';
                try {
                    const j = await res.json();
                    if (j && j.message) msg = j.message;
                } catch (e) {}
                throw new Error(msg);
            }
            return await res.json();
        }

        function formatRupiah(amount) {
            const n = Number(amount || 0);
            return 'Rp' + new Intl.NumberFormat('id-ID').format(Math.max(0, Math.trunc(n)));
        }

        function formatDateTime(dt) {
            if (!dt) return '-';
            const d = new Date(dt);
            if (Number.isNaN(d.getTime())) return String(dt);
            return new Intl.DateTimeFormat('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
            }).format(d);
        }

        function openModal() {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            updatePaymentSummary();
        }

        function closeModal() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        window.closeModal = closeModal;

        function renderInvoice(data) {
            const appt = (data && data.appointment) ? data.appointment : {};
            const items = Array.isArray(data && data.items) ? data.items : [];

            currentInvoiceData = data || null;

            setInvoiceTotal(data && data.total);
            setPaymentStatus(appt.payment_status);

            invEls.patientName.textContent = appt.patient_name || '-';
            invEls.patientMr.textContent = appt.medical_record_number || '-';
            invEls.patientAge.textContent = (appt.age === null || appt.age === undefined || appt.age === '') ? '-' : String(appt.age);
            invEls.patientPhone.textContent = appt.patient_phone || '-';
            invEls.doctorName.textContent = appt.doctor_name || '-';

            invEls.code.textContent = appt.code || '-';
            invEls.date.textContent = formatDateTime(appt.start_at);

            // payment method select
            if (payEls.method) {
                const val = String(appt.payment_method || '').trim();
                if (val) payEls.method.value = val;
            }

            // default paid by: use last paid_by if exists, otherwise patient name
            if (payEls.paidBy && !String(payEls.paidBy.value || '').trim()) {
                const defaultPaidBy = String(appt.paid_by || '').trim() || String(appt.patient_name || '').trim();
                payEls.paidBy.value = defaultPaidBy;
            }

            invEls.itemsBody.innerHTML = '';
            if (items.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = '<td colspan="6" style="color:#64748b;text-align:center;padding:18px">Belum ada tindakan/obat.</td>';
                invEls.itemsBody.appendChild(tr);
            } else {
                items.forEach(function (it) {
                    const tr = document.createElement('tr');

                    const tdDate = document.createElement('td');
                    tdDate.style.color = '#64748b';
                    tdDate.style.fontSize = '12px';
                    tdDate.textContent = formatDateTime(it.created_at);

                    const tdName = document.createElement('td');
                    tdName.style.fontWeight = '600';
                    tdName.style.color = '#111827';
                    tdName.style.display = 'flex';
                    tdName.style.alignItems = 'center';
                    tdName.style.justifyContent = 'space-between';
                    tdName.style.gap = '10px';

                    const nameSpan = document.createElement('span');
                    nameSpan.textContent = it.name || '-';
                    tdName.appendChild(nameSpan);

                    if (invoiceEditMode) {
                        const delBtn = document.createElement('button');
                        delBtn.type = 'button';
                        delBtn.textContent = '×';
                        delBtn.title = 'Hapus item';
                        delBtn.style.border = 'none';
                        delBtn.style.background = 'transparent';
                        delBtn.style.cursor = 'pointer';
                        delBtn.style.color = '#9ca3af';
                        delBtn.style.fontSize = '18px';
                        delBtn.addEventListener('click', async function () {
                            if (!confirm('Hapus item ini?')) return;
                            try {
                                await deleteInvoiceItem(it.id);
                                await loadInvoiceByAppointmentId(currentAppointmentId);
                            } catch (e) {
                                alert(e && e.message ? e.message : 'Gagal menghapus item');
                            }
                        });
                        tdName.appendChild(delBtn);
                    }

                    const tdQty = document.createElement('td');
                    const tdPrice = document.createElement('td');
                    const tdDisc = document.createElement('td');
                    const tdTotal = document.createElement('td');
                    tdTotal.style.fontWeight = '700';
                    tdTotal.textContent = formatRupiah(it.line_total);

                    if (invoiceEditMode) {
                        const qtyInput = document.createElement('input');
                        qtyInput.type = 'number';
                        qtyInput.min = '1';
                        qtyInput.step = '1';
                        qtyInput.value = String(it.quantity ?? 1);
                        qtyInput.style.width = '70px';
                        qtyInput.style.border = '1px solid #ddd';
                        qtyInput.style.borderRadius = '4px';
                        qtyInput.style.padding = '6px 8px';

                        const priceInput = document.createElement('input');
                        priceInput.type = 'number';
                        priceInput.min = '0';
                        priceInput.step = '1';
                        priceInput.value = String(it.selling_price ?? 0);
                        priceInput.style.width = '110px';
                        priceInput.style.border = '1px solid #ddd';
                        priceInput.style.borderRadius = '4px';
                        priceInput.style.padding = '6px 8px';

                        const discInput = document.createElement('input');
                        discInput.type = 'number';
                        discInput.min = '0';
                        discInput.step = '1';
                        discInput.value = String(it.discount_amount ?? 0);
                        discInput.style.width = '90px';
                        discInput.style.border = '1px solid #ddd';
                        discInput.style.borderRadius = '4px';
                        discInput.style.padding = '6px 8px';

                        const saveOnBlur = async function () {
                            try {
                                await patchInvoiceItem(it.id, {
                                    quantity: safeInt(qtyInput.value, 1),
                                    selling_price: safeInt(priceInput.value, 0),
                                    discount_amount: safeInt(discInput.value, 0),
                                });
                                await loadInvoiceByAppointmentId(currentAppointmentId);
                            } catch (e) {
                                alert(e && e.message ? e.message : 'Gagal menyimpan perubahan');
                            }
                        };

                        qtyInput.addEventListener('blur', saveOnBlur);
                        priceInput.addEventListener('blur', saveOnBlur);
                        discInput.addEventListener('blur', saveOnBlur);

                        tdQty.appendChild(qtyInput);
                        tdPrice.appendChild(priceInput);
                        tdDisc.appendChild(discInput);
                    } else {
                        tdQty.textContent = String(it.quantity ?? 1);
                        tdPrice.textContent = formatRupiah(it.selling_price);
                        tdDisc.textContent = formatRupiah(it.discount_amount);
                    }

                    tr.appendChild(tdDate);
                    tr.appendChild(tdName);
                    tr.appendChild(tdQty);
                    tr.appendChild(tdPrice);
                    tr.appendChild(tdDisc);
                    tr.appendChild(tdTotal);

                    invEls.itemsBody.appendChild(tr);
                });
            }

            invEls.total.textContent = formatRupiah(data && data.total);

            // default bayar mengikuti referensi: awal 0 (atau outstanding jika partial)
            if (currentPaymentStatus === 'paid') {
                if (payEls.submit) payEls.submit.textContent = 'Lunas';
                setPayButtonEnabled(false);
            } else {
                if (payEls.submit) payEls.submit.textContent = 'Bayar';
                if (payEls.amount) {
                    const paidAmount = safeInt(appt.paid_amount, 0);
                    const outstanding = safeInt(appt.outstanding_amount, Math.max(0, currentInvoiceTotal - paidAmount));
                    const defaultPay = (String(currentPaymentStatus) === 'partial') ? outstanding : 0;
                    // only overwrite if empty / 0 (so user input isn't clobbered during refresh)
                    const existing = safeInt(payEls.amount.value, 0);
                    if (existing === 0) payEls.amount.value = String(defaultPay);
                }
                updatePaymentSummary();
            }
        }

        function setPayButtonEnabled(enabled) {
            if (!payEls.submit) return;
            payEls.submit.disabled = !enabled;
            if (enabled) payEls.submit.classList.add('active');
            else payEls.submit.classList.remove('active');
        }

        function resetPaymentForm() {
            setInvoiceTotal(0);
            setPaymentStatus('unpaid');
            if (payEls.amount) payEls.amount.value = '0';
            if (payEls.paidBy) payEls.paidBy.value = '';
            if (payEls.change) payEls.change.value = 'Rp0';
            if (payEls.debt) payEls.debt.value = 'Rp0';
            setPayButtonEnabled(false);
        }

        function updatePaymentSummary() {
            if (currentPaymentStatus === 'paid') {
                setPayButtonEnabled(false);
                return;
            }
            const amountPaid = Number(payEls.amount && payEls.amount.value ? payEls.amount.value : 0);
            const paidBy = String(payEls.paidBy && payEls.paidBy.value ? payEls.paidBy.value : '').trim();
            const safePaid = Number.isFinite(amountPaid) && amountPaid >= 0 ? Math.trunc(amountPaid) : 0;

            const change = Math.max(0, safePaid - currentInvoiceTotal);
            const debt = Math.max(0, currentInvoiceTotal - safePaid);

            if (payEls.change) payEls.change.value = formatRupiah(change);
            if (payEls.debt) payEls.debt.value = formatRupiah(debt);

            const canPay = !!currentAppointmentId && currentInvoiceTotal > 0 && paidBy.length > 0 && safePaid > 0;
            setPayButtonEnabled(canPay);
        }

        if (invEls.editToggle) {
            invEls.editToggle.addEventListener('click', function (e) {
                e.preventDefault();
                invoiceEditMode = !invoiceEditMode;
                if (invEls.editToggle) invEls.editToggle.textContent = invoiceEditMode ? 'selesai' : 'edit';
                if (currentInvoiceData) renderInvoice(currentInvoiceData);
            });
        }

        if (payEls.method) {
            payEls.method.addEventListener('change', async function () {
                try {
                    await savePaymentMethod(payEls.method.value);
                } catch (e) {
                    alert(e && e.message ? e.message : 'Gagal menyimpan metode pembayaran');
                }
            });
        }

        if (payEls.amount) payEls.amount.addEventListener('input', updatePaymentSummary);
        if (payEls.paidBy) payEls.paidBy.addEventListener('input', updatePaymentSummary);

        // Bayar button handlers (open invoice modal)
        document.querySelectorAll('.btn-bayar').forEach(function(btn) {
            btn.addEventListener('click', async function() {
                const url = btn.getAttribute('data-invoice-url');
                if (!url) return;

                const originalLabel = btn.textContent;

                try {
                    btn.disabled = true;
                    btn.textContent = 'Memuat...';

                    const res = await fetch(url, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    if (!res.ok) throw new Error('Gagal memuat invoice');

                    const data = await res.json();
                    setCurrentAppointment(data && data.appointment ? data.appointment.id : null);
                    renderInvoice(data);
                    // keep summary up to date
                    updatePaymentSummary();
                    openModal();
                } catch (e) {
                    alert(e && e.message ? e.message : 'Terjadi kesalahan saat memuat invoice');
                } finally {
                    btn.disabled = false;
                    btn.textContent = originalLabel;
                }
            });
        });

        async function submitPayment() {
            if (!currentAppointmentId) throw new Error('Pilih invoice terlebih dahulu');
            const amountPaid = Number(payEls.amount && payEls.amount.value ? payEls.amount.value : 0);
            const paidBy = String(payEls.paidBy && payEls.paidBy.value ? payEls.paidBy.value : '').trim();
            const safePaid = Number.isFinite(amountPaid) && amountPaid >= 0 ? Math.trunc(amountPaid) : 0;
            const paymentMethod = String(payEls.method && payEls.method.value ? payEls.method.value : '').trim();

            if (!paidBy) throw new Error('Nama pembayar wajib diisi');
            if (currentInvoiceTotal <= 0) throw new Error('Total invoice masih Rp0');

            const url = payUrlBase + '/' + currentAppointmentId + '/pay';
            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                },
                body: JSON.stringify({
                    amount_paid: safePaid,
                    paid_by: paidBy,
                    payment_method: paymentMethod || null,
                })
            });

            if (!res.ok) {
                let msg = 'Gagal menyimpan pembayaran';
                try {
                    const j = await res.json();
                    if (j && j.message) msg = j.message;
                } catch (e) {}
                throw new Error(msg);
            }

            return await res.json();
        }

        if (payEls.submit) {
            payEls.submit.addEventListener('click', async function () {
                try {
                    payEls.submit.disabled = true;
                    const result = await submitPayment();
                    alert('Pembayaran tersimpan. Status: ' + (result.payment_status || '-'));
                    // refresh list page to reflect changes
                    window.location.reload();
                } catch (e) {
                    alert(e && e.message ? e.message : 'Terjadi kesalahan saat menyimpan pembayaran');
                } finally {
                    updatePaymentSummary();
                }
            });
        }

        // --- Create invoice: search appointment + add item ---
        const createApptSearch = document.getElementById('createApptSearch');
        const createApptResults = document.getElementById('createApptResults');
        const createProcedure = document.getElementById('createProcedure');
        const createName = document.getElementById('createName');
        const createQty = document.getElementById('createQty');
        const createPrice = document.getElementById('createPrice');
        const createDiscount = document.getElementById('createDiscount');
        const createAddItemBtn = document.getElementById('createAddItemBtn');

        let searchDebounceTimer = null;

        function showApptResults(items) {
            if (!createApptResults) return;
            if (!items || items.length === 0) {
                createApptResults.style.display = 'none';
                createApptResults.innerHTML = '';
                return;
            }

            createApptResults.style.display = 'block';
            createApptResults.innerHTML = items.map(function (it) {
                return '<button type="button" class="appt-pick" data-id="' + it.id + '" style="width:100%;text-align:left;padding:10px 12px;border:none;background:#fff;border-bottom:1px solid #f1f5f9;cursor:pointer">' +
                    '<span style="font-size:13px;color:#111827;font-weight:600">' + (it.label || '-') + '</span>' +
                '</button>';
            }).join('');

            createApptResults.querySelectorAll('.appt-pick').forEach(function (b) {
                b.addEventListener('click', async function () {
                    const id = b.getAttribute('data-id');
                    if (!id) return;

                    try {
                        await loadInvoiceByAppointmentId(id);
                        if (createApptResults) {
                            createApptResults.style.display = 'none';
                            createApptResults.innerHTML = '';
                        }
                    } catch (e) {
                        alert(e && e.message ? e.message : 'Gagal memilih appointment');
                    }
                });
            });
        }

        async function searchAppointments(q) {
            const u = new URL(searchApptUrl, window.location.origin);
            u.searchParams.set('q', q);
            const res = await fetch(u.toString(), {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            if (!res.ok) throw new Error('Gagal mencari data');
            return await res.json();
        }

        if (createApptSearch) {
            createApptSearch.addEventListener('input', function () {
                const q = String(createApptSearch.value || '').trim();
                clearTimeout(searchDebounceTimer);

                if (q.length < 2) {
                    showApptResults([]);
                    return;
                }

                searchDebounceTimer = setTimeout(async function () {
                    try {
                        const json = await searchAppointments(q);
                        showApptResults(json && json.data ? json.data : []);
                    } catch (e) {
                        showApptResults([]);
                    }
                }, 250);
            });
        }

        if (createProcedure) {
            createProcedure.addEventListener('change', function () {
                const opt = createProcedure.options[createProcedure.selectedIndex];
                if (!opt) return;
                const name = opt.getAttribute('data-name');
                const price = opt.getAttribute('data-price');
                if (name && createName && !String(createName.value || '').trim()) {
                    createName.value = name;
                }
                if (price && createPrice) {
                    createPrice.value = String(parseInt(price, 10) || 0);
                }
            });
        }

        async function addInvoiceItem() {
            if (!currentAppointmentId) {
                throw new Error('Pilih pasien/appointment dulu');
            }
            const payload = {
                procedure_id: createProcedure && createProcedure.value ? Number(createProcedure.value) : null,
                name: createName ? String(createName.value || '').trim() : '',
                quantity: createQty ? Number(createQty.value || 1) : 1,
                selling_price: createPrice ? Number(createPrice.value || 0) : 0,
                discount_amount: createDiscount ? Number(createDiscount.value || 0) : 0,
            };

            const url = invoiceBaseUrl + '/' + currentAppointmentId + '/items';
            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                },
                body: JSON.stringify(payload)
            });

            if (!res.ok) {
                let msg = 'Gagal menambah item';
                try {
                    const j = await res.json();
                    if (j && j.message) msg = j.message;
                } catch (e) {}
                throw new Error(msg);
            }
        }

        if (createAddItemBtn) {
            createAddItemBtn.addEventListener('click', async function () {
                try {
                    createAddItemBtn.disabled = true;
                    await addInvoiceItem();
                    await loadInvoiceByAppointmentId(currentAppointmentId);
                    if (createName) createName.value = '';
                    if (createQty) createQty.value = '1';
                    if (createDiscount) createDiscount.value = '0';
                    if (payEls.amount) payEls.amount.value = String(currentInvoiceTotal);
                    updatePaymentSummary();
                } catch (e) {
                    alert(e && e.message ? e.message : 'Terjadi kesalahan');
                } finally {
                    createAddItemBtn.disabled = false;
                }
            });
        }

        // Tab switch logic
        const tabPembayaran = document.querySelector('.cashier-sidebar .tab:nth-child(1)');
        const tabHutang = document.querySelector('.cashier-sidebar .tab:nth-child(2)');
        const pembayaranSection = document.getElementById('pembayaran-section');
        const hutangSection = document.getElementById('hutang-section');
        tabPembayaran.onclick = function() {
            tabPembayaran.classList.add('active');
            tabHutang.classList.remove('active');
            pembayaranSection.style.display = '';
            hutangSection.style.display = 'none';
        };
        tabHutang.onclick = function() {
            tabHutang.classList.add('active');
            tabPembayaran.classList.remove('active');
            pembayaranSection.style.display = 'none';
            hutangSection.style.display = '';
        };

        // Tombol + Pembayaran belum diaktifkan

        // Tutup jika klik di luar area konten modal (overlay)
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        };
    </script>
</body>

</html>
