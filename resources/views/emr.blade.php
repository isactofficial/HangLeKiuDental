<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Electronic Medical Record - Hanglekiu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --main-bg: #f8f9fa;
            --surface: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --accent: #2196F3;
            --action: #1E88E5;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--main-bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
        }

        .main {
            margin-left: 60px;
            flex: 1;
            padding: 0 12px;
        }

        .hamburger {
            display: inline-flex;
            background: var(--surface);
            border: none;
            padding: 0;
            cursor: pointer;
            justify-content: center;
            align-items: center;
            height: 36px;
            width: 36px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            position: relative;
            margin-right: 12px;
            z-index: 1001;
        }

        .hamburger i {
            color: var(--accent);
            font-size: 18px;
            line-height: 1;
            display: block;
        }

        .emr-header {
            display: flex;
            align-items: center;
            background: var(--surface);
            border-bottom: 1px solid rgba(0,0,0,0.04);
            padding: 14px 20px;
            position: relative;
            gap: 12px;
        }

        .emr-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
            min-width: 0;
        }

        .emr-header-search {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            min-width: 0;
        }

        .emr-header-search input {
            flex: 1;
            width: auto;
            max-width: 520px;
            padding: 10px 14px;
            border-radius: 24px;
            border: 1px solid rgba(0,0,0,0.06);
            box-shadow: none;
            min-width: 0;
        }

        .advance-btn {
            background: var(--action);
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            font-size: 16px;
            margin-left: 8px;
            cursor: pointer;
        }

        .emr-header-right {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-left: auto;
        }

        .emr-header-user {
            position: relative;
        }

        .user-btn {
            background: var(--action);
            color: #fff;
            padding: 8px 14px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            border: none;
            font-weight: 500;
        }

        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--action);
            font-weight: 700;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--surface);
            border: 1px solid rgba(0,0,0,0.04);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.08);
            display: none;
            width: 160px;
            z-index: 10050;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            color: #374151;
            text-decoration: none;
            font-size: 15px;
        }

        .dropdown-item:hover {
            background: var(--main-bg);
        }

        .floating-actions {
            position: absolute;
            right: 28px;
            top: 72px;
            display: flex;
            flex-direction: row;
            gap: 10px;
            z-index: 1000;
        }

        .floating-actions button {
            background: var(--surface);
            border: 1px solid rgba(0,0,0,0.04);
            padding: 10px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: box-shadow 0.2s;
        }

        .emr-title {
            padding: 18px 28px;
            background: var(--surface);
        }

        .emr-title h1 {
            color: var(--text);
            font-size: 28px;
            margin-bottom: 6px;
        }

        .emr-title p {
            color: var(--muted);
            margin-top: 0;
        }

        .legend {
            display: flex;
            gap: 18px;
            align-items: center;
            padding: 8px 28px;
            background: var(--surface);
            border-bottom: 1px solid #eee;
        }

        .legend .item {
            display: flex;
            gap: 8px;
            align-items: center;
            font-size: 13px;
            color: var(--muted);
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
        }

        .emr-content {
            padding: 26px;
            background: var(--main-bg);
            min-height: 60vh;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 20px;
            align-items: start;
        }

        .patient-card {
            background: #fff;
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 4px;
            overflow: hidden;
        }

        .patient-filter {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .patient-select {
            width: 100%;
            padding: 8px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #333;
        }

        .patient-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .patient-item {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            font-size: 14px;
            color: #666;
            transition: 0.2s;
        }

        .patient-item:hover {
            background: #f5f5f5;
        }

        .patient-item.active {
            background: #2196F3;
            color: #fff;
            border-left: 4px solid #1565C0;
            font-weight: 500;
        }

        .detail-area {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .profile-box {
            background: #fff;
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 4px;
            padding: 20px;
            position: relative;
        }

        .profile-header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .profile-name {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 4px;
        }

        .profile-meta {
            font-size: 13px;
            color: #777;
            line-height: 1.5;
        }

        .edit-data-btn {
            background: #fff;
            border: 1px solid #333;
            padding: 8px 16px;
            font-size: 11px;
            font-weight: 600;
            border-radius: 3px;
            cursor: pointer;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .profile-body-row {
            display: flex;
            gap: 25px;
            align-items: flex-start;
        }

        .profile-pic-container {
            width: 140px;
            height: 140px;
            background: #B0BEC5;
            border-radius: 4px;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-pic-container::after {
            content: '';
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            position: absolute;
            top: 30px;
        }

        .profile-pic-container::before {
            content: '';
            width: 110px;
            height: 60px;
            background: rgba(255,255,255,0.3);
            border-radius: 50% 50% 0 0;
            position: absolute;
            bottom: 0;
        }

        .profile-details-area {
            flex: 1;
        }

        .info-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .info-item label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 700;
            color: #444;
            margin-bottom: 6px;
        }

        .info-item span {
            font-size: 13px;
            color: #888;
            display: block;
            min-height: 18px;
        }

        .icon-hidden {
            font-size: 12px;
            color: #666;
            cursor: pointer;
        }

        .expanded-content {
            display: none;
            margin-top: 10px;
        }

        .expanded-content.show {
            display: block;
        }

        .section-label {
            font-size: 13px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
            margin-top: 20px;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }

        .detail-table th,
        .detail-table td {
            border: 1px solid #ccc;
            padding: 6px 10px;
            font-size: 11px;
            text-align: left;
        }

        .detail-table th {
            background: #f5f5f5;
            color: #333;
            font-weight: 600;
        }

        .detail-table td {
            color: #555;
        }

        .link-toggle {
            display: block;
            text-align: right;
            margin-top: 15px;
            color: #2196F3;
            font-size: 12px;
            text-decoration: none;
            cursor: pointer;
            font-weight: 500;
        }

        .main-tabs {
            display: flex;
            gap: 0;
            border-bottom: 2px solid #E91E63;
            background: #fff;
            padding: 0 20px;
        }

        .main-tab-link {
            padding: 16px 30px;
            font-size: 13px;
            font-weight: 600;
            color: #666;
            text-decoration: none;
            border-bottom: 3px solid transparent;
            cursor: pointer;
            background: transparent;
            transition: all 0.2s;
            border: none;
            margin-bottom: -2px;
        }

        .main-tab-link:hover {
            color: #E91E63;
        }

        .main-tab-link.active {
            color: #E91E63;
            border-bottom: 3px solid #E91E63;
        }

        .sub-tabs {
            display: none;
            background: #f5f5f5;
            padding: 10px 20px;
            gap: 8px;
            flex-wrap: wrap;
        }

        .sub-tabs.active {
            display: flex;
        }

        .sub-tab-btn {
            background: #d1d5db;
            border: none;
            padding: 10px 20px;
            font-size: 12px;
            font-weight: 600;
            color: #555;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .sub-tab-btn:hover {
            background: #b0b5bd;
        }

        .sub-tab-btn.active {
            background: #2196F3;
            color: #fff;
        }

        .tab-content-area {
            display: none;
        }

        .tab-content-area.active {
            display: block;
        }

        .record-content-box {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 20px;
            overflow: hidden;
        }

        .record-header {
            background: #2196F3;
            color: #fff;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .record-toolbar {
            display: flex;
            gap: 10px;
        }

        .toolbar-btn {
            background: transparent;
            border: none;
            color: #fff;
            cursor: pointer;
            padding: 5px 10px;
        }

        .record-table-container {
            padding: 20px;
        }

        .record-table {
            width: 100%;
            border-collapse: collapse;
        }

        .record-table th {
            background: #0D47A1;
            color: #fff;
            padding: 12px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
        }

        .record-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
            color: #333;
        }

        .record-table tr:nth-child(even) {
            background: #FFF9E6;
        }

        .record-table tr:hover {
            background: #f0f0f0;
        }

        .pagination-info {
            padding: 15px 20px;
            font-size: 12px;
            color: #666;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eee;
        }

        .pagination-controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .page-btn {
            background: transparent;
            border: 1px solid #ddd;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .page-btn:hover {
            background: #f5f5f5;
        }

        .rows-selector {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .record-subtab-content {
            display: none;
        }

        .record-subtab-content.active {
            display: block;
        }

        .clinical-layout {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 20px;
            margin-top: 20px;
        }

        .timeline-container {
            position: relative;
            padding-left: 0;
            border-left: none;
        }

        .timeline-date {
            position: static;
            width: auto;
            text-align: left;
            font-weight: 600;
            color: #333;
            font-size: 13px;
            line-height: 1.2;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .timeline-dot {
            position: static;
            width: 12px;
            height: 12px;
            background: #8BC34A;
            border-radius: 50%;
            border: none;
            box-shadow: none;
            flex-shrink: 0;
        }

        .med-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .card-header {
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid #eee;
        }

        .payment-badge {
            display: inline-block;
            background: #FFF8E1;
            border: 1px solid #333;
            padding: 6px 10px;
            font-weight: 600;
            font-size: 11px;
            border-radius: 3px;
            margin-top: 6px;
        }

        .btn-done {
            background: #8BC34A;
            color: #fff;
            border: none;
            padding: 5px 10px;
            font-weight: 600;
            font-size: 11px;
            border-radius: 3px;
            display: flex;
            align-items: center;
            gap: 4px;
            cursor: pointer;
        }

        .proc-section {
            padding: 0 15px 15px;
        }

        .proc-title {
            color: #2196F3;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .proc-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            background: #FFF8E1;
        }

        .proc-table th {
            text-align: left;
            padding: 10px;
            color: #666;
            font-weight: 600;
            border-bottom: 1px solid #eee;
        }

        .proc-table td {
            padding: 10px;
            color: #555;
            vertical-align: top;
            border-bottom: 1px solid #eee;
        }

        .proc-table tr:last-child td {
            border-bottom: none;
        }

        .btn-block-gray {
            display: block;
            width: 100%;
            background: #D1D5DB;
            border: none;
            padding: 10px;
            color: #555;
            font-weight: 600;
            font-size: 12px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-block-blue {
            display: block;
            width: 100%;
            background: #1565C0;
            color: #fff;
            border: none;
            padding: 10px;
            font-weight: 700;
            font-size: 12px;
            margin-bottom: 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        .accordion-item {
            border: 1px solid #ddd;
            background: #fff;
            border-bottom: none;
            margin-bottom: 0;
        }

        .accordion-item:last-child {
            border-bottom: 1px solid #ddd;
        }

        .accordion-header {
            padding: 14px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            background: #fff;
            text-transform: uppercase;
        }

        .accordion-header:hover {
            background: #f9f9f9;
        }

        .accordion-header i {
            color: #999;
            transition: transform 0.3s;
        }

        .accordion-header.active i {
            transform: rotate(180deg);
        }

        .accordion-body {
            display: none;
            padding: 20px 15px;
            background: #f9f9f9;
            border-top: 1px solid #eee;
        }

        .accordion-body.open {
            display: block;
        }

        .acc-input {
            width: 100%;
            border: none;
            border-bottom: 1px solid #ddd;
            padding: 8px 30px 8px 0;
            margin-bottom: 0;
            background: transparent;
            outline: none;
            font-size: 13px;
            color: #333;
            position: relative;
        }

        .acc-input:focus {
            border-bottom-color: #2196F3;
        }

        .acc-input::placeholder {
            color: #999;
        }

        .input-with-icon {
            position: relative;
            margin-bottom: 15px;
        }

        .input-with-icon i {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 16px;
            cursor: pointer;
        }

        .checkbox-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 15px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: space-between;
            padding: 8px 0;
        }

        .checkbox-item input[type="radio"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #2196F3;
        }

        .checkbox-item label {
            font-size: 13px;
            color: #666;
            cursor: pointer;
            margin: 0;
            flex: 1;
        }

        .subtitle-section {
            font-size: 12px;
            font-weight: 600;
            color: #666;
            margin-top: 20px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        /* Modal Styles - Updated to match image */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal-content {
            background: #fff;
            width: 100%;
            max-width: 1200px;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 4px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .modal-header {
            padding: 15px 20px;
            background: #f5f5f5;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            text-align: left;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #999;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-body {
            padding: 20px;
        }

        .form-section {
            background: #2196F3;
            color: #fff;
            padding: 10px 15px;
            font-size: 13px;
            font-weight: 600;
            margin: 0 0 20px 0;
        }

        .form-section:not(:first-child) {
            margin-top: 30px;
        }

        .modal-photo-section {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .photo-upload-box {
            width: 140px;
            height: 170px;
            border: 2px solid #ddd;
            border-radius: 4px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #fafafa;
            cursor: pointer;
            flex-shrink: 0;
        }

        .photo-upload-box i {
            font-size: 40px;
            color: #ccc;
            margin-bottom: 10px;
        }

        .photo-upload-box span {
            font-size: 11px;
            color: #999;
            text-align: center;
        }

        .modal-form-grid {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 11px;
            color: #2196F3;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 13px;
            background: #fff;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #2196F3;
        }

        .form-group input[readonly] {
            background: #f5f5f5;
            color: #999;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-simpan {
            background: #EF4444;
            color: #fff;
            border: none;
            padding: 10px 30px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
        }

        .btn-simpan:hover {
            background: #DC2626;
        }

        .mr-info {
            font-size: 11px;
            color: #999;
            margin-top: 5px;
        }

        .chat-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: #0066FF;
            color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            cursor: pointer;
        }

        .hidden {
            display: none !important;
        }

        @media (max-width: 1100px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            .clinical-layout {
                grid-template-columns: 1fr;
            }
            .profile-body-row {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .info-grid-3,
            .info-grid-4 {
                grid-template-columns: 1fr;
                text-align: left;
                width: 100%;
            }
            .modal-form-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 900px) {
            .hamburger {
                position: static;
                margin-right: 8px;
            }
            .emr-header {
                position: relative;
                padding-left: 12px;
                min-height: 56px;
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
                padding: 16px 10px 10px 10px;
            }
            .emr-header-search input {
                width: 100%;
                max-width: none;
            }
            .main {
                margin-left: 0;
                padding: 0 10px;
            }
            .floating-actions {
                position: fixed;
                right: 12px;
                top: auto;
                bottom: 20px;
                flex-direction: column;
            }
            .modal-photo-section {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    @include('partials.sidebar')

    <main class="main">
        <div class="emr-header">
            <button class="hamburger" onclick="toggleSidebar()" aria-label="Menu">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>
            <div class="emr-header-left">
                <div class="emr-header-search">
                    <form action="{{ route('emr') }}" method="GET" style="display: flex; width: 100%; gap: 10px;">
                        <input type="text" name="search" placeholder="Cari Pasien / No MR / No Hp.." value="{{ request('search') }}">
                        <button type="submit" class="advance-btn">Search</button>
                    </form>
                </div>
            </div>
            <div class="emr-header-right">
                <div class="emr-header-user">
                    <div class="user-btn">
                        <div class="user-avatar"><i class="fas fa-user"></i></div>
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="dropdown-menu">
                        <a href="/profile" class="dropdown-item">
                            <i class="fas fa-user" style="margin-right:8px;color:#6b7280;"></i> Profile
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item" style="color:#e11d48; width: 100%; border: none; background: none; cursor: pointer;">
                                <i class="fas fa-sign-out-alt" style="margin-right:8px;color:#e11d48;"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="floating-actions">
                <button title="Print" onclick="window.print()"><i class="fas fa-print" style="color:var(--accent)"></i></button>
                <button title="Refresh" onclick="location.reload()"><i class="fas fa-sync" style="color:var(--accent)"></i></button>
            </div>
        </div>

        <section class="emr-title">
            <h1>Electronic Medical Record</h1>
            <p>hanglekiu dental specialist</p>
        </section>

        <div class="legend">
            <div class="item"><span class="dot" style="background:#f87171"></span> Pending</div>
            <div class="item"><span class="dot" style="background:#fbbf24"></span> Confirmed</div>
            <div class="item"><span class="dot" style="background:#a78bfa"></span> Waiting</div>
            <div class="item"><span class="dot" style="background:var(--accent)"></span> Engaged</div>
            <div class="item"><span class="dot" style="background:#86efac"></span> Succeed</div>
        </div>

        <div class="emr-content">
            <div class="content-grid">
                <div class="patient-card">
                    <div class="patient-filter">
                        <form action="{{ route('emr') }}" method="GET">
                            <select name="status" class="patient-select" onchange="this.form.submit()">
                                <option value="Semua" {{ request('status') == 'Semua' ? 'selected' : '' }}>Semua</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="waiting" {{ request('status') == 'waiting' ? 'selected' : '' }}>Waiting</option>
                                <option value="engaged" {{ request('status') == 'engaged' ? 'selected' : '' }}>Engaged</option>
                                <option value="succeed" {{ request('status') == 'succeed' ? 'selected' : '' }}>Succeed</option>
                            </select>
                        </form>
                    </div>
                    <ul class="patient-list">
                        @forelse($patients as $index => $patient)
                            <li class="patient-item {{ $index === 0 ? 'active' : '' }}" data-patient="{{ $patient['id'] }}">
                                {{ $patient['name'] }}
                            </li>
                        @empty
                            <li style="padding: 20px; text-align: center; color: #999;">
                                Tidak ada data pasien
                            </li>
                        @endforelse
                    </ul>
                </div>

                <div class="detail-area">
                    @foreach($patients as $index => $patient)
                        @php
                            $birthDate = \Carbon\Carbon::parse($patient['birth_date']);
                            $age = $birthDate->age;
                            $daysDiff = $birthDate->diffInDays(\Carbon\Carbon::now()->startOfDay()) % 365;
                        @endphp
                        <div class="patient-data {{ $index !== 0 ? 'hidden' : '' }}" id="patient-{{ $patient['id'] }}">
                            <div class="profile-box">
                                <div class="profile-header-row">
                                    <div>
                                        <div class="profile-name">{{ $patient['name'] }}</div>
                                        <div class="profile-meta">
                                            {{ $patient['medical_record_number'] }} · {{ $patient['gender'] }} · {{ $age }} Tahun {{ $daysDiff }} Hari<br>
                                            {{ $birthDate->format('d F Y') }}
                                        </div>
                                    </div>
                                    <button class="edit-data-btn" onclick="openModal('{{ $patient['id'] }}')">EDIT DATA DIRI</button>
                                </div>

                                <div class="profile-body-row">
                                    <div class="profile-pic-container"></div>
                                    <div class="profile-details-area">
                                        <div class="info-grid-3">
                                            <div class="info-item">
                                                <label>Alamat Rumah <i class="fas fa-eye-slash icon-hidden"></i></label>
                                                <span>-</span>
                                            </div>
                                            <div class="info-item">
                                                <label>Nomor KTP <i class="fas fa-eye-slash icon-hidden"></i></label>
                                                <span>-</span>
                                            </div>
                                            <div class="info-item">
                                                <label>Nomor HP <i class="fas fa-eye-slash icon-hidden"></i></label>
                                                <span>{{ $patient['phone'] ?? '-' }}</span>
                                            </div>
                                        </div>

                                        <div class="expanded-content" id="expanded-{{ $patient['id'] }}">
                                            <div class="info-grid-4">
                                                <div class="info-item">
                                                    <label>Pekerjaan</label>
                                                    <span>-</span>
                                                </div>
                                                <div class="info-item">
                                                    <label>Status</label>
                                                    <span>-</span>
                                                </div>
                                                <div class="info-item">
                                                    <label>Gol. Darah</label>
                                                    <span>-</span>
                                                </div>
                                                <div class="info-item">
                                                    <label>Agama</label>
                                                    <span>-</span>
                                                </div>
                                            </div>

                                            <div class="section-label">Anggota Keluarga</div>
                                            <table class="detail-table">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Lengkap</th>
                                                        <th>Hubungan</th>
                                                        <th>Tanggal Lahir</th>
                                                        <th>Nomor HP <i class="fas fa-eye-slash"></i></th>
                                                        <th>Alamat <i class="fas fa-eye-slash"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>Lainnya</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="section-label">Metode Pembayaran</div>
                                            <table class="detail-table">
                                                <thead>
                                                    <tr>
                                                        <th>Metode</th>
                                                        <th>Nomor <i class="fas fa-eye"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $patient['latest_appointment']['payment_method'] ?? 'Lainnya' }}</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="section-label">Tags</div>
                                            <div style="height:20px;"></div>
                                        </div>

                                        <a class="link-toggle" onclick="toggleProfileDetails('{{ $patient['id'] }}')" id="btn-toggle-{{ $patient['id'] }}">Lihat data lainnya ></a>
                                    </div>
                                </div>
                            </div>

                            <div class="main-tabs">
                                <button class="main-tab-link active" data-tab="timeline" data-patient="{{ $patient['id'] }}">TIMELINE</button>
                                <button class="main-tab-link" data-tab="record" data-patient="{{ $patient['id'] }}">RECORD</button>
                                <button class="main-tab-link" data-tab="cppt" data-patient="{{ $patient['id'] }}">CPPT</button>
                            </div>

                            <div class="sub-tabs" id="sub-tabs-{{ $patient['id'] }}">
                                <button class="sub-tab-btn active" data-subtab="vital">Tanda Vital</button>
                                <button class="sub-tab-btn" data-subtab="diagnosa">Diagnosa</button>
                                <button class="sub-tab-btn" data-subtab="dokter">Catatan Dokter</button>
                                <button class="sub-tab-btn" data-subtab="prosedur">Prosedur</button>
                                <button class="sub-tab-btn" data-subtab="resep">Resep</button>
                                <button class="sub-tab-btn" data-subtab="racikan">Racikan</button>
                                <button class="sub-tab-btn" data-subtab="odontogram">Odontogram</button>
                                <button class="sub-tab-btn" data-subtab="more">...</button>
                            </div>

                            <div class="tab-content-area active" id="timeline-{{ $patient['id'] }}">
                                <div class="clinical-layout">
                                    <div class="timeline-container">
                                        @foreach($patient['appointments']->groupBy(function($app) { return \Carbon\Carbon::parse($app->start_at)->format('Y-m-d'); }) as $date => $dayAppointments)
                                            <div class="timeline-date">
                                                <div class="timeline-dot"></div>
                                                {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                                            </div>

                                            @foreach($dayAppointments as $appointment)
                                                <div class="med-card">
                                                    <div class="card-header">
                                                        <div>
                                                            <div style="font-size:13px; margin-bottom:5px; color:#333;">
                                                                {{ $appointment->procedure }} dengan
                                                                <a href="#" style="color:#2196F3; font-weight:500;">
                                                                    {{ $appointment->doctor->name }} {{ $appointment->doctor->specialty }}
                                                                </a>
                                                            </div>
                                                            <div class="payment-badge">Metode Pembayaran: {{ $appointment->payment_method }}</div>
                                                            <div style="font-size:11px; color:#999; margin-top:5px;">
                                                                {{ \Carbon\Carbon::parse($appointment->start_at)->format('H:i') }} WIB
                                                                selama {{ $appointment->duration_minutes }} menit
                                                            </div>
                                                            <a href="#" style="font-size:11px; font-weight:600; color:#2196F3; display:block; margin-top:5px;">CPPT</a>
                                                        </div>
                                                        <div style="display:flex; gap:10px; align-items:center;">
                                                            <i class="fas fa-print" style="color:#999; font-size:14px;"></i>
                                                            <i class="fas fa-eye" style="color:#999; font-size:14px;"></i>
                                                            <button class="btn-done">{{ strtoupper($appointment->status) }} <i class="fas fa-chevron-down"></i></button>
                                                        </div>
                                                    </div>

                                                    @if($appointment->procedure)
                                                    <div class="proc-section">
                                                        <div class="proc-title">
                                                            <span>PROSEDUR</span>
                                                            <span style="font-size:10px; color:#999; font-weight:400;">
                                                                oleh <a href="#" style="color:#2196F3;">
                                                                    {{ $appointment->createdByUser ? $appointment->createdByUser->name : 'System' }}
                                                                </a>
                                                            </span>
                                                        </div>
                                                        <table class="proc-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Prosedur</th>
                                                                    <th>Catatan</th>
                                                                    <th>Tanggal Input</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ $appointment->procedure }}</td>
                                                                    <td>-</td>
                                                                    <td>{{ \Carbon\Carbon::parse($appointment->created_at)->format('d-m-Y H:i') }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endforeach

                                        <div style="text-align:center; padding:20px; color:#999; font-size:12px;">
                                            Page has reached maximum limit.
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn-block-gray">+TAMBAH DIAGNOSA</button>
                                        <button class="btn-block-blue">PRINT REKAM MEDIS</button>

                                        <!-- RIWAYAT PENYAKIT -->
                                        <div class="accordion-item">
                                            <div class="accordion-header" onclick="toggleAcc(this)">
                                                <span>RIWAYAT PENYAKIT</span>
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                            <div class="accordion-body">
                                                <div class="subtitle-section">TAMBAH RIWAYAT PENYAKIT</div>
                                                <div class="input-with-icon">
                                                    <input type="text" class="acc-input" placeholder="Nama Penyakit">
                                                    <i class="fas fa-plus-circle"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- RIWAYAT PENYAKIT KELUARGA -->
                                        <div class="accordion-item">
                                            <div class="accordion-header" onclick="toggleAcc(this)">
                                                <span>RIWAYAT PENYAKIT KELUARGA</span>
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                            <div class="accordion-body">
                                                <div style="color: #999; font-size: 13px; margin-bottom: 15px;">
                                                    Pasien tidak memiliki riwayat penyakit keluarga.
                                                </div>
                                            </div>
                                        </div>

                                        <!-- RIWAYAT ALERGI -->
                                        <div class="accordion-item">
                                            <div class="accordion-header" onclick="toggleAcc(this)">
                                                <span>RIWAYAT ALERGI</span>
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                            <div class="accordion-body">
                                                <div style="color: #999; font-size: 13px; margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center;">
                                                    <span>Pasien tidak memiliki riwayat alergi</span>
                                                    <i class="fas fa-info-circle" style="color: #999; font-size: 18px;"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- RIWAYAT PENGGUNAAN OBAT -->
                                        <div class="accordion-item">
                                            <div class="accordion-header" onclick="toggleAcc(this)">
                                                <span>RIWAYAT PENGGUNAAN OBAT</span>
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                            <div class="accordion-body">
                                                <div style="color: #999; font-size: 13px; margin-bottom: 15px;">
                                                    Pasien tidak memiliki riwayat penggunaan obat
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content-area" id="record-{{ $patient['id'] }}">
                                <div class="record-subtab-content active" data-subtab="prosedur">
                                    <div class="record-content-box">
                                        <div class="record-header">
                                            <span>PROSEDUR</span>
                                            <div class="record-toolbar">
                                                <button class="toolbar-btn" title="Print"><i class="fas fa-print"></i></button>
                                            </div>
                                        </div>
                                        <div class="record-table-container">
                                            <table class="record-table">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>Prosedur</th>
                                                        <th>Dokter</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($patient['appointments'] as $appointment)
                                                        <tr>
                                                            <td style="color:#2196F3;">
                                                                {{ strtoupper(\Carbon\Carbon::parse($appointment->start_at)->format('M d Y')) }}
                                                            </td>
                                                            <td>{{ $appointment->procedure }}</td>
                                                            <td>{{ $appointment->doctor->name }}</td>
                                                            <td>{{ ucfirst($appointment->status) }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" style="text-align:center; padding:40px; color:#999;">No data available</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="pagination-info">
                                            <div>
                                                <span>Total: {{ $patient['appointments']->count() }} records</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content-area" id="cppt-{{ $patient['id'] }}">
                                <div style="background:#fff; padding:40px; text-align:center; margin-top:20px; border-radius:4px;">
                                    <p style="color:#999;">CPPT content will be displayed here</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="chat-float">
            <i class="fas fa-comment-dots"></i>
        </div>

        <!-- Modal Edit Data Pasien -->
        <div class="modal-overlay" id="editModal">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Edit Data Pasien</div>
                    <button class="modal-close" onclick="closeModal()">&times;</button>
                </div>
                <form id="editPatientForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-section">Informasi Dasar</div>

                        <div class="modal-photo-section">
                            <div class="photo-upload-box">
                                <i class="far fa-image"></i>
                                <span>Pilih Foto</span>
                            </div>

                            <div class="modal-form-grid">
                                <div class="form-group">
                                    <label>Nama Lengkap *</label>
                                    <input type="text" name="patient_name" id="modal-nama" required>
                                </div>

                                <div class="form-group">
                                    <label>Nomor Medical Record</label>
                                    <input type="text" name="medical_record_number" id="modal-mr" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Lahir *</label>
                                    <input type="date" name="patient_birth_date" id="modal-tgl" required>
                                </div>

                                <div class="form-group">
                                    <label>Jenis Kelamin *</label>
                                    <select name="patient_gender" id="modal-gender" required>
                                        <option value="Perempuan">Perempuan</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-form-grid">
                            <div class="form-group">
                                <label>Nomor HP</label>
                                <input type="tel" name="patient_phone" id="modal-hp" placeholder="Nomor HP">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn-simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('appSidebar');
                if(sidebar) sidebar.classList.toggle('open');
            }

            // User dropdown
            (function(){
                const userBtn = document.querySelector('.user-btn');
                const dropdownMenu = document.querySelector('.dropdown-menu');
                if(!userBtn || !dropdownMenu) return;
                userBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    dropdownMenu.style.display = dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '' ? 'block' : 'none';
                });
                document.addEventListener('click', (event) => {
                    if (!userBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.style.display = 'none';
                    }
                });
            })();

            let currentPatient = null;
            const patientData = {};

            // Patient item click
            document.querySelectorAll('.patient-item').forEach(item => {
                item.addEventListener('click', function() {
                    document.querySelectorAll('.patient-item').forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    const patientId = this.getAttribute('data-patient');
                    currentPatient = patientId;
                    document.querySelectorAll('.patient-data').forEach(pd => pd.classList.add('hidden'));
                    const targetPatient = document.getElementById('patient-' + patientId);
                    if(targetPatient) targetPatient.classList.remove('hidden');
                });
            });

            // Main tabs
            document.querySelectorAll('.main-tab-link').forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-tab');
                    const patientId = this.getAttribute('data-patient');
                    const parentTabs = this.closest('.main-tabs');
                    parentTabs.querySelectorAll('.main-tab-link').forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    const patientContainer = document.getElementById('patient-' + patientId);
                    patientContainer.querySelectorAll('.tab-content-area').forEach(content => {
                        content.classList.remove('active');
                    });
                    const targetContent = document.getElementById(targetTab + '-' + patientId);
                    if(targetContent) targetContent.classList.add('active');
                    const subTabs = document.getElementById('sub-tabs-' + patientId);
                    if(targetTab === 'record') {
                        subTabs.classList.add('active');
                    } else {
                        subTabs.classList.remove('active');
                    }
                });
            });

            // Sub tabs
            document.querySelectorAll('.sub-tab-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const targetSubTab = this.getAttribute('data-subtab');
                    const parentSubTabs = this.closest('.sub-tabs');
                    parentSubTabs.querySelectorAll('.sub-tab-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    const patientId = parentSubTabs.id.replace('sub-tabs-', '');
                    const recordContent = document.getElementById('record-' + patientId);
                    if(recordContent) {
                        recordContent.querySelectorAll('.record-subtab-content').forEach(content => {
                            content.classList.remove('active');
                        });
                        const targetContent = recordContent.querySelector(`[data-subtab="${targetSubTab}"]`);
                        if(targetContent) targetContent.classList.add('active');
                    }
                });
            });

            function toggleProfileDetails(patientId) {
                var expandedContent = document.getElementById('expanded-' + patientId);
                var btn = document.getElementById('btn-toggle-' + patientId);
                if (expandedContent.style.display === 'block') {
                    expandedContent.style.display = 'none';
                    btn.innerHTML = 'Lihat data lainnya >';
                } else {
                    expandedContent.style.display = 'block';
                    btn.innerHTML = '< Sembunyikan data';
                }
            }

            function toggleAcc(header) {
                const body = header.nextElementSibling;
                const allHeaders = document.querySelectorAll('.accordion-header');
                const allBodies = document.querySelectorAll('.accordion-body');

                allHeaders.forEach(h => {
                    if(h !== header) {
                        h.classList.remove('active');
                    }
                });
                allBodies.forEach(b => {
                    if(b !== body) {
                        b.classList.remove('open');
                    }
                });

                header.classList.toggle('active');
                body.classList.toggle('open');
            }

            function openModal(patientId) {
                currentPatient = patientId;
                fetch(`/emr/patient/${patientId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('modal-nama').value = data.name || '';
                        document.getElementById('modal-mr').value = data.medical_record_number || '';
                        document.getElementById('modal-tgl').value = data.birth_date || '';
                        document.getElementById('modal-gender').value = data.gender || 'Perempuan';
                        document.getElementById('modal-hp').value = data.phone || '';
                        document.getElementById('editModal').style.display = 'flex';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal memuat data pasien');
                    });
            }

            function closeModal() {
                document.getElementById('editModal').style.display = 'none';
            }

            // Handle form submission
            document.getElementById('editPatientForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const data = Object.fromEntries(formData);

                fetch(`/emr/patient/${currentPatient}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert('Data pasien berhasil diperbarui');
                        closeModal();
                        location.reload();
                    } else {
                        alert('Gagal memperbarui data pasien');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui data');
                });
            });

            window.onclick = function(event) {
                var modal = document.getElementById('editModal');
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            // Set first patient as current on load
            const firstPatient = document.querySelector('.patient-item');
            if (firstPatient) {
                currentPatient = firstPatient.getAttribute('data-patient');
            }
        </script>
    </main>
</body>
</html>
