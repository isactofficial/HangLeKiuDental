<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <input type="text" placeholder="Cari Pasien / No MR / No Ktp / No Asuransi..">
                    <button class="advance-btn">Advance Search</button>
                </div>
            </div>
            <div class="emr-header-right">
                <div class="emr-header-user">
                    <div class="user-btn">
                        <div class="user-avatar"><i class="fas fa-user"></i></div>
                        <span>User</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="dropdown-menu">
                        <a href="/profile" class="dropdown-item">
                            <i class="fas fa-user" style="margin-right:8px;color:#6b7280;"></i> Profile
                        </a>
                        <a href="#" onclick="alert('Logout')" class="dropdown-item" style="color:#e11d48;">
                            <i class="fas fa-sign-out-alt" style="margin-right:8px;color:#e11d48;"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
            <div class="floating-actions">
                <button title="Print"><i class="fas fa-print" style="color:var(--accent)"></i></button>
                <button title="Refresh"><i class="fas fa-sync" style="color:var(--accent)"></i></button>
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
                        <select class="patient-select">
                            <option>Semua</option>
                        </select>
                    </div>
                    <ul class="patient-list">
                        <li class="patient-item" data-patient="endang">Bu Endang Pamuncak</li>
                        <li class="patient-item active" data-patient="anggie">Anggie dwi savitri</li>
                        <li class="patient-item" data-patient="asfarina">Asfarina</li>
                    </ul>
                </div>

                <div class="detail-area">
                    <div class="patient-data" id="patient-anggie">
                        <div class="profile-box">
                            <div class="profile-header-row">
                                <div>
                                    <div class="profile-name">Anggie dwi savitri</div>
                                    <div class="profile-meta">
                                        MR000076 · Perempuan · 29 Tahun 2 Hari<br>
                                        04 Januari 1997
                                    </div>
                                </div>
                                <button class="edit-data-btn" onclick="openModal('anggie')">EDIT DATA DIRI</button>
                            </div>

                            <div class="profile-body-row">
                                <div class="profile-pic-container"></div>
                                <div class="profile-details-area">
                                    <div class="info-grid-3">
                                        <div class="info-item">
                                            <label>Alamat Rumah <i class="fas fa-eye-slash icon-hidden"></i></label>
                                            <span>Solo, Jawa Tengah</span>
                                        </div>
                                        <div class="info-item">
                                            <label>Nomor KTP <i class="fas fa-eye-slash icon-hidden"></i></label>
                                            <span>3372000000000001</span>
                                        </div>
                                        <div class="info-item">
                                            <label>Nomor HP <i class="fas fa-eye-slash icon-hidden"></i></label>
                                            <span>08120000000</span>
                                        </div>
                                    </div>

                                    <div class="expanded-content" id="expanded-anggie">
                                        <div class="info-grid-4">
                                            <div class="info-item">
                                                <label>Pekerjaan</label>
                                                <span>Swasta</span>
                                            </div>
                                            <div class="info-item">
                                                <label>Status</label>
                                                <span>Menikah</span>
                                            </div>
                                            <div class="info-item">
                                                <label>Gol. Darah</label>
                                                <span>B</span>
                                            </div>
                                            <div class="info-item">
                                                <label>Agama</label>
                                                <span>Islam</span>
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
                                                    <td>Lainnya</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="section-label">Tags</div>
                                        <div style="height:20px;"></div>
                                    </div>

                                    <a class="link-toggle" onclick="toggleProfileDetails('anggie')" id="btn-toggle-anggie">Lihat data lainnya ></a>
                                </div>
                            </div>
                        </div>

                        <div class="main-tabs">
                            <button class="main-tab-link active" data-tab="timeline" data-patient="anggie">TIMELINE</button>
                            <button class="main-tab-link" data-tab="record" data-patient="anggie">RECORD</button>
                            <button class="main-tab-link" data-tab="cppt" data-patient="anggie">CPPT</button>
                        </div>

                        <div class="sub-tabs" id="sub-tabs-anggie">
                            <button class="sub-tab-btn active" data-subtab="vital">Tanda Vital</button>
                            <button class="sub-tab-btn" data-subtab="diagnosa">Diagnosa</button>
                            <button class="sub-tab-btn" data-subtab="dokter">Catatan Dokter</button>
                            <button class="sub-tab-btn" data-subtab="prosedur">Prosedur</button>
                            <button class="sub-tab-btn" data-subtab="resep">Resep</button>
                            <button class="sub-tab-btn" data-subtab="racikan">Racikan</button>
                            <button class="sub-tab-btn" data-subtab="odontogram">Odontogram</button>
                            <button class="sub-tab-btn" data-subtab="more">...</button>
                        </div>

                        <div class="tab-content-area active" id="timeline-anggie">
                            <div class="clinical-layout">
                                <div class="timeline-container">
                                    <div class="timeline-date">
                                        <div class="timeline-dot"></div>
                                        25 Nov 2025
                                    </div>

                                    <div class="med-card">
                                        <div class="card-header">
                                            <div>
                                                <div style="font-size:13px; margin-bottom:5px; color:#333;">
                                                    Poli Gigi dengan <a href="#" style="color:#2196F3; font-weight:500;">drg. Ria Budiati Sp. Ortho</a>
                                                </div>
                                                <div class="payment-badge">Metode Pembayaran: Langsung</div>
                                                <div style="font-size:11px; color:#999; margin-top:5px;">13:22 WIB selama 33 menit</div>
                                                <a href="#" style="font-size:11px; font-weight:600; color:#2196F3; display:block; margin-top:5px;">CPPT</a>
                                            </div>
                                            <div style="display:flex; gap:10px; align-items:center;">
                                                <i class="fas fa-print" style="color:#999; font-size:14px;"></i>
                                                <i class="fas fa-eye" style="color:#999; font-size:14px;"></i>
                                                <button class="btn-done">DONE <i class="fas fa-chevron-down"></i></button>
                                            </div>
                                        </div>

                                        <div class="proc-section">
                                            <div class="proc-title">
                                                <span>PROSEDUR</span>
                                                <span style="font-size:10px; color:#999; font-weight:400;">oleh <a href="#" style="color:#2196F3;">Sonia Noritasari</a></span>
                                            </div>
                                            <table class="proc-table">
                                                <thead>
                                                    <tr>
                                                        <th>Prosedur</th>
                                                        <th>Catatan</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                        <th>Tenaga Medis Utama</th>
                                                        <th>Tenaga Medis Bantu</th>
                                                        <th>Tanggal Input</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Kontrol Ortho-Semua Iko Midwani</td>
                                                        <td></td>
                                                        <td>1</td>
                                                        <td>Rp250.000</td>
                                                        <td>drg. Ria Budiati Sp. Ortho</td>
                                                        <td></td>
                                                        <td>25-11-2025 13:55</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ungual Button</td>
                                                        <td></td>
                                                        <td>2</td>
                                                        <td>Rp200.000</td>
                                                        <td>drg. Ria Budiati Sp. Ortho</td>
                                                        <td></td>
                                                        <td>25-11-2025 13:55</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bizzle</td>
                                                        <td></td>
                                                        <td>1</td>
                                                        <td>Rp100.000</td>
                                                        <td>drg. Ria Budiati Sp. Ortho</td>
                                                        <td></td>
                                                        <td>25-11-2025 13:55</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

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

                                            <div class="subtitle-section" style="margin-top: 10px; margin-bottom: 8px; font-weight: 400;">Saran</div>

                                            <div class="checkbox-list">
                                                <div class="checkbox-item">
                                                    <label for="diabetes">Diabetes</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                                <div class="checkbox-item">
                                                    <label for="asma">Asma</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                                <div class="checkbox-item">
                                                    <label for="insomnia">Insomnia</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                                <div class="checkbox-item">
                                                    <label for="menyusui">Menyusui</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                                <div class="checkbox-item">
                                                    <label for="masa-hamil">Masa Hamil</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
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

                                            <div class="subtitle-section">TAMBAH RIWAYAT PENYAKIT KELUARGA</div>

                                            <div class="input-with-icon">
                                                <input type="text" class="acc-input" placeholder="Nama Penyakit">
                                                <i class="fas fa-plus-circle"></i>
                                            </div>

                                            <div class="subtitle-section" style="margin-top: 10px; margin-bottom: 8px; font-weight: 400;">Saran</div>

                                            <div class="checkbox-list">
                                                <div class="checkbox-item">
                                                    <label for="kel-diabetes">Diabetes</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                                <div class="checkbox-item">
                                                    <label for="kel-asma">Asma</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                                <div class="checkbox-item">
                                                    <label for="kel-insomnia">Insomnia</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                                <div class="checkbox-item">
                                                    <label for="kel-menyusui">Menyusui</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                                <div class="checkbox-item">
                                                    <label for="kel-masa-hamil">Masa Hamil</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
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

                                            <div class="subtitle-section">TAMBAH RIWAYAT ALERGI</div>

                                            <div class="input-with-icon">
                                                <input type="text" class="acc-input" placeholder="Nama Alergi">
                                                <i class="fas fa-plus-circle"></i>
                                            </div>

                                            <div class="subtitle-section" style="margin-top: 10px; margin-bottom: 8px; font-weight: 400;">Cari Nama Alergi</div>

                                            <div class="subtitle-section" style="margin-top: 10px; margin-bottom: 8px; font-weight: 400;">Saran</div>

                                            <div class="checkbox-list">
                                                <div class="checkbox-item">
                                                    <label for="dingin">Dingin</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                                <div class="checkbox-item">
                                                    <label for="antibiotik">Antibiotik</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                                <div class="checkbox-item">
                                                    <label for="debu">Debu</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                                <div class="checkbox-item">
                                                    <label for="susu">Susu</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
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

                                            <div class="subtitle-section">TAMBAH DATA RIWAYAT PENGGUNAAN OBAT</div>

                                            <div class="input-with-icon">
                                                <input type="text" class="acc-input" placeholder="Nama Obat">
                                                <i class="fas fa-plus-circle"></i>
                                            </div>

                                            <div class="subtitle-section" style="margin-top: 10px; margin-bottom: 8px; font-weight: 400;">Saran</div>

                                            <div class="checkbox-list">
                                                <div class="checkbox-item">
                                                    <label for="panadol">Panadol</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                                <div class="checkbox-item">
                                                    <label for="konsistin">Konsistin</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                                <div class="checkbox-item">
                                                    <label for="procol">Procol</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                                <div class="checkbox-item">
                                                    <label for="mixagrip">Mixagrip</label>
                                                    <i class="far fa-plus-square" style="margin-left: auto; font-size: 20px; color: #999; cursor: pointer;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content-area" id="record-anggie">
                            <div class="record-subtab-content active" data-subtab="vital">
                                <div class="record-content-box">
                                    <div class="record-header">
                                        <span>VITAL SIGNS</span>
                                        <div class="record-toolbar">
                                            <button class="toolbar-btn" title="Print"><i class="fas fa-print"></i></button>
                                            <button class="toolbar-btn" style="background:#2196F3; border-radius:4px; padding:8px 15px;">+ Tambah</button>
                                        </div>
                                    </div>
                                    <div class="record-table-container">
                                        <table class="record-table">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Weight</th>
                                                    <th>Height</th>
                                                    <th>Blood Pulse</th>
                                                    <th>Pulse</th>
                                                    <th>Temperature</th>
                                                    <th>Resp. Rate</th>
                                                    <th>Blood Sugar</th>
                                                    <th>Oxygen Saturation</th>
                                                    <th>Lingkar Perut</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="10" style="text-align:center; padding:40px; color:#999;">No data available</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pagination-info">
                                        <div>
                                            <span>Rows per page: </span>
                                            <select class="rows-selector">
                                                <option>5</option>
                                                <option>10</option>
                                                <option>20</option>
                                            </select>
                                        </div>
                                        <div class="pagination-controls">
                                            <span>0-0 of 0</span>
                                            <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                                            <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="record-subtab-content" data-subtab="diagnosa">
                                <div class="record-content-box">
                                    <div class="record-header">
                                        <span>DIAGNOSA</span>
                                        <div class="record-toolbar">
                                            <button class="toolbar-btn" title="Print"><i class="fas fa-print"></i></button>
                                            <button class="toolbar-btn" style="background:#2196F3; border-radius:4px; padding:8px 15px;">+ Tambah</button>
                                        </div>
                                    </div>
                                    <div class="record-table-container">
                                        <table class="record-table">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Diagnosa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" style="text-align:center; padding:40px; color:#999;">No data available</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pagination-info">
                                        <div>
                                            <span>Rows per page: </span>
                                            <select class="rows-selector">
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="pagination-controls">
                                            <span>0-0 of 0</span>
                                            <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                                            <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="record-subtab-content" data-subtab="dokter">
                                <div class="record-content-box">
                                    <div class="record-header">
                                        <span>CATATAN DOKTER</span>
                                        <div class="record-toolbar">
                                            <button class="toolbar-btn" title="Print"><i class="fas fa-print"></i></button>
                                            <button class="toolbar-btn" style="background:#2196F3; border-radius:4px; padding:8px 15px;">+ Tambah</button>
                                        </div>
                                    </div>
                                    <div class="record-table-container">
                                        <table class="record-table">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" style="text-align:center; padding:40px; color:#999;">No data available</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pagination-info">
                                        <div>
                                            <span>Rows per page: </span>
                                            <select class="rows-selector">
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="pagination-controls">
                                            <span>0-0 of 0</span>
                                            <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                                            <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="record-subtab-content" data-subtab="prosedur">
                                <div class="record-content-box">
                                    <div class="record-header">
                                        <span>PROSEDUR</span>
                                        <div class="record-toolbar">
                                            <button class="toolbar-btn" title="Print"><i class="fas fa-print"></i></button>
                                            <button class="toolbar-btn" style="background:#2196F3; border-radius:4px; padding:8px 15px;">+ Tambah</button>
                                        </div>
                                    </div>
                                    <div class="record-table-container">
                                        <table class="record-table">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Prosedur</th>
                                                    <th>Jumlah</th>
                                                    <th>Notes</th>
                                                    <th>Harga Jual</th>
                                                    <th>Diskon</th>
                                                    <th>Tenaga Medis Utama</th>
                                                    <th>Tenaga Medis Bantu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="color:#2196F3;">NOV 25 2025</td>
                                                    <td>Kontrol Ortho-Semua Iko Midwani</td>
                                                    <td>1</td>
                                                    <td></td>
                                                    <td>Rp250.000</td>
                                                    <td>Rp0</td>
                                                    <td>drg. Ria Budiati Sp. Ortho</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td style="color:#2196F3;">NOV 25 2025</td>
                                                    <td>Ungual Button</td>
                                                    <td>2</td>
                                                    <td></td>
                                                    <td>Rp200.000</td>
                                                    <td>Rp0</td>
                                                    <td>drg. Ria Budiati Sp. Ortho</td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pagination-info">
                                        <div>
                                            <span>Rows per page: </span>
                                            <select class="rows-selector">
                                                <option selected>5</option>
                                            </select>
                                        </div>
                                        <div class="pagination-controls">
                                            <span>1-2 of 2</span>
                                            <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                                            <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="record-subtab-content" data-subtab="resep">
                                <div class="record-content-box">
                                    <div class="record-header">
                                        <span>RESEP</span>
                                        <div class="record-toolbar">
                                            <button class="toolbar-btn" title="Print"><i class="fas fa-print"></i></button>
                                            <button class="toolbar-btn" style="background:#2196F3; border-radius:4px; padding:8px 15px;">+ Tambah</button>
                                        </div>
                                    </div>
                                    <div class="record-table-container">
                                        <table class="record-table">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Nama Obat</th>
                                                    <th>Jumlah</th>
                                                    <th>Satuan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="4" style="text-align:center; padding:40px; color:#999;">No data available</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pagination-info">
                                        <div>
                                            <span>Rows per page: </span>
                                            <select class="rows-selector">
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="pagination-controls">
                                            <span>0-0 of 0</span>
                                            <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                                            <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="record-subtab-content" data-subtab="racikan">
                                <div class="record-content-box">
                                    <div class="record-header">
                                        <span>RACIKAN</span>
                                        <div class="record-toolbar">
                                            <button class="toolbar-btn" title="Print"><i class="fas fa-print"></i></button>
                                            <button class="toolbar-btn" style="background:#2196F3; border-radius:4px; padding:8px 15px;">+ Tambah</button>
                                        </div>
                                    </div>
                                    <div class="record-table-container">
                                        <table class="record-table">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Nama Racikan</th>
                                                    <th>Jumlah</th>
                                                    <th>Satuan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="4" style="text-align:center; padding:40px; color:#999;">No data available</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pagination-info">
                                        <div>
                                            <span>Rows per page: </span>
                                            <select class="rows-selector">
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="pagination-controls">
                                            <span>0-0 of 0</span>
                                            <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                                            <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="record-subtab-content" data-subtab="odontogram">
                                <div class="record-content-box">
                                    <div class="record-header">
                                        <span>ODONTOGRAM</span>
                                        <div class="record-toolbar">
                                            <button class="toolbar-btn" title="Print"><i class="fas fa-print"></i></button>
                                            <button class="toolbar-btn" style="background:#2196F3; border-radius:4px; padding:8px 15px;">+ Tambah</button>
                                        </div>
                                    </div>
                                    <div class="record-table-container">
                                        <table class="record-table">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" style="text-align:center; padding:40px; color:#999;">No data available</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pagination-info">
                                        <div>
                                            <span>Rows per page: </span>
                                            <select class="rows-selector">
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="pagination-controls">
                                            <span>0-0 of 0</span>
                                            <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                                            <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content-area" id="cppt-anggie">
                            <div style="background:#fff; padding:40px; text-align:center; margin-top:20px; border-radius:4px;">
                                <p style="color:#999;">CPPT content will be displayed here</p>
                            </div>
                        </div>
                    </div>
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
                <div class="modal-body">
                    <!-- Informasi Dasar -->
                    <div class="form-section">Informasi Dasar</div>

                    <div class="modal-photo-section">
                        <div class="photo-upload-box">
                            <i class="far fa-image"></i>
                            <span>Pilih Foto</span>
                        </div>

                        <div class="modal-form-grid">
                            <div class="form-group">
                                <label>Nama Lengkap *</label>
                                <input type="text" id="modal-nama" value="Bu Endang Pamuncak">
                            </div>

                            <div class="form-group">
                                <label>Nomor Medical Record</label>
                                <input type="text" id="modal-mr" value="MR000077" readonly>
                                <div class="mr-info">Nomor RM tersebut yang dipakaikan MR000077</div>
                            </div>

                            <div class="form-group">
                                <label>Kota Tempat Lahir</label>
                                <input type="text" id="modal-kota" placeholder="Kota Lahir">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir *</label>
                                <input type="date" id="modal-tgl" value="1987-12-17">
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-grid">
                        <div class="form-group">
                            <label>Jenis Kelamin *</label>
                            <select id="modal-gender">
                                <option>Perempuan</option>
                                <option>Laki-laki</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jenis Klaim *</label>
                            <select id="modal-klaim">
                                <option>Tidak Tahu</option>
                                <option>Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Golongan Darah *</label>
                            <select id="modal-goldarah">
                                <option>Tidak Tahu</option>
                                <option>A</option>
                                <option>B</option>
                                <option>AB</option>
                                <option>O</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Agama *</label>
                            <select id="modal-agama">
                                <option>Lainnya</option>
                                <option>Islam</option>
                                <option>Kristen</option>
                                <option>Katolik</option>
                                <option>Hindu</option>
                                <option>Buddha</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="tel" id="modal-hp" placeholder="Nomor HP">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="modal-email" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label>Tanggal Meninggal Dunia</label>
                            <input type="date" id="modal-tgl-meninggal">
                        </div>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="form-section">Metode Pembayaran</div>

                    <div class="modal-form-grid">
                        <div class="form-group">
                            <label>Metode Pembayaran *</label>
                            <select id="modal-payment">
                                <option>Lainnya</option>
                                <option>Langsung</option>
                                <option>Asuransi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>+ TAMBAH METODE</label>
                            <input type="text" placeholder="Tambah Metode Pembayaran">
                        </div>
                    </div>

                    <!-- Tempat Tinggal -->
                    <div class="form-section">Tempat Tinggal</div>

                    <div class="modal-form-grid">
                        <div class="form-group">
                            <label>Alamat Rumah *</label>
                            <input type="text" id="modal-alamat" placeholder="Alamat">
                        </div>

                        <div class="form-group">
                            <label>Provinsi</label>
                            <select id="modal-provinsi">
                                <option>Provinsi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kota / Kabupaten</label>
                            <select id="modal-kota-kab">
                                <option>Kecamatan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kecamatan</label>
                            <select id="modal-kecamatan">
                                <option>Kelurahan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kode Pos</label>
                            <input type="text" id="modal-kodepos" placeholder="Kode Pos">
                        </div>
                    </div>

                    <!-- Anggota Keluarga / Penanggung Jawab -->
                    <div class="form-section">Anggota Keluarga / Penanggung Jawab</div>

                    <div style="margin-bottom: 15px;">
                        <button style="background:#2196F3; color:#fff; border:none; padding:8px 16px; border-radius:4px; font-size:12px; cursor:pointer;">
                            + TAMBAH
                        </button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn-simpan" onclick="closeModal()">Simpan</button>
                </div>
            </div>
        </div>

        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('appSidebar');
                if(sidebar) sidebar.classList.toggle('open');
            }

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

            let currentPatient = 'anggie';
            const patientData = {
                anggie: { nama: 'Anggie dwi savitri', mr: 'MR000076', tgl: '1997-01-04', kota: 'Surakarta' },
                endang: { nama: 'Bu Endang Pamuncak', mr: 'MR000077', tgl: '1987-12-17', kota: '' }
            };

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

                // Close all other accordions
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

                // Toggle current accordion
                header.classList.toggle('active');
                body.classList.toggle('open');
            }

            function openModal(patientId) {
                const patient = patientData[patientId || currentPatient];
                document.getElementById('modal-nama').value = patient.nama;
                document.getElementById('modal-mr').value = patient.mr;
                document.getElementById('modal-tgl').value = patient.tgl;
                document.getElementById('modal-kota').value = patient.kota;
                document.getElementById('editModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('editModal').style.display = 'none';
            }

            window.onclick = function(event) {
                var modal = document.getElementById('editModal');
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </main>
</body>
</html>
