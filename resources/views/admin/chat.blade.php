<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Hỗ Trợ Khách Hàng | AI CỦA TÔI Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --primary-glow: rgba(79, 70, 229, 0.15);
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            --text-main: #0f172a;
            --text-muted: #475569;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Left */
        .sidebar {
            width: 260px;
            background: #0f172a;
            color: #94a3b8;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #ffffff;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .logo-area i {
            color: var(--primary-light);
            font-size: 1.5rem;
        }

        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            flex-grow: 1;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #94a3b8;
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .menu-item a:hover, .menu-item.active a {
            background: #1e293b;
            color: #ffffff;
        }

        .menu-item.active a i {
            color: var(--primary-light);
        }

        /* Main Wrapper Right */
        .main-wrapper {
            margin-left: 260px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            height: 100vh;
        }

        .top-navbar {
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            flex-shrink: 0;
        }

        .page-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .user-info-bar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .admin-avatar {
            width: 2.25rem;
            height: 2.25rem;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .admin-name {
            font-size: 0.875rem;
            font-weight: 600;
        }

        .admin-badge {
            font-size: 0.7rem;
            background: #fef2f2;
            color: #ef4444;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 700;
        }

        /* Chat Layout Grid */
        .chat-layout {
            flex: 1;
            display: grid;
            grid-template-columns: 320px 1fr;
            min-height: 0; /* Important for flex child overflow scrolling */
            background: #ffffff;
            border-top: 1px solid var(--border-color);
        }

        /* Left Conversations Column */
        .convo-list-panel {
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            background: #f8fafc;
            min-height: 0;
        }

        .search-convo-box {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            background: #ffffff;
        }

        .search-convo-input {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            outline: none;
        }

        .conversations-wrapper {
            flex: 1;
            overflow-y: auto;
        }

        .convo-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            cursor: pointer;
            transition: background 0.2s ease;
            position: relative;
        }

        .convo-item:hover {
            background: #f1f5f9;
        }

        .convo-item.active {
            background: #e2e8f0;
            border-left: 4px solid var(--primary);
        }

        .convo-avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background: var(--primary-glow);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            position: relative;
            flex-shrink: 0;
        }

        .convo-info {
            flex: 1;
            min-width: 0;
        }

        .convo-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.25rem;
        }

        .convo-name {
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--text-main);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .convo-time {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .convo-preview {
            font-size: 0.78rem;
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .unread-indicator {
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            position: absolute;
            right: 1rem;
            top: 2.2rem;
        }

        /* Right Message View Column */
        .chat-view-panel {
            display: flex;
            flex-direction: column;
            background: #ffffff;
            min-height: 0;
        }

        .chat-view-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            flex-shrink: 0;
        }

        .active-user-name {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .active-user-meta {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.15rem;
        }

        .chat-messages-container {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .msg-bubble-wrapper {
            display: flex;
            width: 100%;
        }

        .msg-bubble-wrapper.admin-sender {
            justify-content: flex-end;
        }

        .msg-bubble-wrapper.user-sender {
            justify-content: flex-start;
        }

        .msg-bubble {
            max-width: 65%;
            padding: 0.75rem 1rem;
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            line-height: 1.5;
            box-shadow: var(--shadow-sm);
        }

        .msg-bubble-wrapper.admin-sender .msg-bubble {
            background: var(--primary);
            color: #ffffff;
            border-bottom-right-radius: 2px;
        }

        .msg-bubble-wrapper.user-sender .msg-bubble {
            background: #e2e8f0;
            color: var(--text-main);
            border-bottom-left-radius: 2px;
        }

        .msg-timestamp {
            font-size: 0.65rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
            display: block;
            text-align: right;
        }

        .msg-bubble-wrapper.user-sender .msg-timestamp {
            text-align: left;
        }

        .chat-input-panel {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-color);
            background: #ffffff;
            display: flex;
            gap: 0.75rem;
            align-items: center;
            flex-shrink: 0;
        }

        .chat-textarea {
            flex: 1;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 0.6rem 0.85rem;
            font-family: inherit;
            font-size: 0.875rem;
            outline: none;
            resize: none;
            height: 38px;
            background: #ffffff;
            color: var(--text-main);
        }

        .btn-send-chat {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            padding: 0.6rem 1.25rem;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
            height: 38px;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-send-chat:hover {
            opacity: 0.9;
        }

        .no-chat-selected {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            background: #f8fafc;
            text-align: center;
            padding: 2rem;
        }

        .no-chat-selected i {
            font-size: 3.5rem;
            color: var(--border-color);
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .main-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar Left -->
    <aside class="sidebar">
        <a href="/" class="logo-area">
            <i class="fa-solid fa-rocket"></i>
            <span>AI CỦA TÔI</span>
        </a>

        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="/admin/dashboard"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            </li>
            <li class="menu-item">
                <a href="/admin/products"><i class="fa-solid fa-cubes"></i> Quản lý sản phẩm</a>
            </li>
            <li class="menu-item">
                <a href="/admin/posts"><i class="fa-solid fa-newspaper"></i> Quản lý bài viết</a>
            </li>
            <li class="menu-item">
                <a href="/admin/orders"><i class="fa-solid fa-shopping-cart"></i> Đơn hàng</a>
            </li>
            <li class="menu-item active">
                <a href="/admin/chat"><i class="fa-solid fa-comments"></i> Hỗ trợ Chat</a>
            </li>
            <li class="menu-item">
                <a href="/admin/customers"><i class="fa-solid fa-users"></i> Khách hàng</a>
            </li>
            <li class="menu-item">
                <a href="/admin/settings"><i class="fa-solid fa-gears"></i> Cấu hình</a>
            </li>
            <li class="menu-item" style="margin-top: auto;">
                <a href="/"><i class="fa-solid fa-house"></i> Quay lại website</a>
            </li>
        </ul>
    </aside>

    <!-- Main Wrapper Right -->
    <div class="main-wrapper">
        <header class="top-navbar">
            <h1 class="page-title">Hỗ Trợ Khách Hàng (Realtime Support)</h1>
            <div class="user-info-bar">
                <div class="admin-avatar">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="admin-name">{{ auth()->user()->name }}</div>
                    <span class="admin-badge">Administrator</span>
                </div>
            </div>
        </header>

        <!-- Chat Layout Grid -->
        <div class="chat-layout">
            
            <!-- Left panel: List of active conversations -->
            <div class="convo-list-panel">
                <div class="search-convo-box">
                    <input type="text" id="search-convo-input" class="search-convo-input" placeholder="Tìm cuộc hội thoại...">
                </div>
                <div class="conversations-wrapper" id="conversations-list-wrapper">
                    <!-- Conversations loaded dynamically -->
                </div>
            </div>

            <!-- Right panel: Active chat conversation messages view -->
            <div class="chat-view-panel" id="chat-messages-view-panel">
                <div class="no-chat-selected" id="no-chat-screen">
                    <i class="fa-solid fa-message-dots"></i>
                    <h3>Chọn cuộc hội thoại</h3>
                    <p style="font-size: 0.8rem; margin-top: 0.5rem;">Hãy chọn một khách hàng ở cột bên trái để bắt đầu hỗ trợ trực tuyến.</p>
                </div>

                <!-- Chat details screen (hidden by default) -->
                <div id="chat-active-screen" style="display: none; flex: 1; flex-direction: column; min-height: 0;">
                    <div class="chat-view-header">
                        <div>
                            <div class="active-user-name" id="active-user-title">Khách hàng #123456</div>
                            <div class="active-user-meta" id="active-user-subtitle">Chưa đăng nhập • session_18a28f</div>
                        </div>
                        <!-- Toggle AI Control -->
                        <div id="ai-toggle-container" style="display: flex; align-items: center; gap: 0.5rem; user-select: none;">
                            <span style="font-size: 0.8rem; font-weight: 700; color: var(--text-muted);">AI Auto Reply:</span>
                            <button type="button" id="admin-ai-toggle-btn" style="border: none; padding: 0.35rem 0.75rem; border-radius: var(--radius-sm); font-size: 0.72rem; font-weight: 800; cursor: pointer; display: flex; align-items: center; gap: 0.25rem; transition: all 0.2s; outline: none;">
                                Đang Bật
                            </button>
                        </div>
                    </div>

                    <!-- Messages list area -->
                    <div class="chat-messages-container" id="active-messages-container">
                        <!-- Messages dynamically rendered -->
                    </div>

                    <!-- Chat reply input footer -->
                    <form class="chat-input-panel" id="chat-reply-form">
                        <input type="file" id="admin-file-input" accept="image/*" style="display: none;">
                        <button type="button" id="admin-upload-btn" style="background: #f1f5f9; border: 1px solid var(--border-color); color: #64748b; width: 2.4rem; height: 2.4rem; border-radius: var(--radius-sm); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s; font-size: 0.95rem; margin-right: 0.25rem;" title="Gửi hình ảnh">
                            <i class="fa-solid fa-camera"></i>
                        </button>
                        <input type="text" id="reply-text-input" class="chat-textarea" placeholder="Nhập câu trả lời của bạn..." autocomplete="off">
                        <button type="submit" class="btn-send-chat">
                            Gửi <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const convoListWrapper = document.getElementById('conversations-list-wrapper');
            const searchConvoInput = document.getElementById('search-convo-input');
            
            const noChatScreen = document.getElementById('no-chat-screen');
            const chatActiveScreen = document.getElementById('chat-active-screen');
            const activeUserTitle = document.getElementById('active-user-title');
            const activeUserSubtitle = document.getElementById('active-user-subtitle');
            const activeMessagesContainer = document.getElementById('active-messages-container');
            const chatReplyForm = document.getElementById('chat-reply-form');
            const replyTextInput = document.getElementById('reply-text-input');
            const adminAiToggleBtn = document.getElementById('admin-ai-toggle-btn');
            const adminFileInput = document.getElementById('admin-file-input');
            const adminUploadBtn = document.getElementById('admin-upload-btn');

            let selectedConvo = null; // { user_id, session_id, is_ai_enabled }
            let messagesPoll = null;
            let currentMessagesCount = 0;
            let conversationsData = [];

            // Fetch conversations on load
            loadConversations();
            
            // Poll conversations list every 5 seconds to detect new active chats or unread badges
            setInterval(loadConversations, 5000);

            // Filter search conversations
            searchConvoInput.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                renderConversations(query);
            });

            // Toggle AI response click handler
            adminAiToggleBtn.addEventListener('click', function() {
                if (!selectedConvo) return;
                
                selectedConvo.is_ai_enabled = !selectedConvo.is_ai_enabled;
                updateAiToggleUI(selectedConvo.is_ai_enabled);
                
                fetch('/admin/api/chat/conversation/toggle-ai', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        user_id: selectedConvo.user_id,
                        session_id: selectedConvo.session_id,
                        is_ai_enabled: selectedConvo.is_ai_enabled
                    })
                })
                .then(res => res.json())
                .then(data => {
                    const match = conversationsData.find(c => 
                        (selectedConvo.user_id && c.user_id == selectedConvo.user_id) ||
                        (!selectedConvo.user_id && c.session_id === selectedConvo.session_id)
                    );
                    if (match) {
                        match.is_ai_enabled = data.is_ai_enabled;
                    }
                })
                .catch(err => console.error(err));
            });

            function updateAiToggleUI(enabled) {
                if (enabled) {
                    adminAiToggleBtn.innerHTML = '🤖 AI: ĐANG BẬT';
                    adminAiToggleBtn.style.background = 'rgba(16, 185, 129, 0.1)';
                    adminAiToggleBtn.style.color = '#10b981';
                    adminAiToggleBtn.style.border = '1px solid #10b981';
                } else {
                    adminAiToggleBtn.innerHTML = '❌ AI: ĐANG TẮT';
                    adminAiToggleBtn.style.background = 'rgba(239, 68, 68, 0.1)';
                    adminAiToggleBtn.style.color = '#ef4444';
                    adminAiToggleBtn.style.border = '1px solid #ef4444';
                }
            }

            function loadConversations() {
                fetch('/admin/api/chat/conversations')
                    .then(res => res.json())
                    .then(data => {
                        conversationsData = data;
                        
                        // Sync current selected conversation AI status if changed externally
                        if (selectedConvo) {
                            const updated = data.find(convo => 
                                ((selectedConvo.user_id && convo.user_id == selectedConvo.user_id) || 
                                 (!selectedConvo.user_id && convo.session_id === selectedConvo.session_id))
                            );
                            if (updated) {
                                selectedConvo.is_ai_enabled = updated.is_ai_enabled;
                                updateAiToggleUI(selectedConvo.is_ai_enabled);
                            }
                        }
                        
                        renderConversations(searchConvoInput.value.toLowerCase().trim());
                    })
                    .catch(err => console.error(err));
            }

            function renderConversations(searchQuery = '') {
                convoListWrapper.innerHTML = '';
                
                const filtered = conversationsData.filter(convo => {
                    return convo.name.toLowerCase().includes(searchQuery) || 
                           (convo.email && convo.email.toLowerCase().includes(searchQuery));
                });

                if (filtered.length === 0) {
                    convoListWrapper.innerHTML = '<div style="padding: 2rem; text-align: center; color: var(--text-muted); font-size: 0.8rem; font-style: italic;">Không tìm thấy cuộc trò chuyện nào</div>';
                    return;
                }

                filtered.forEach(convo => {
                    const item = document.createElement('div');
                    item.className = 'convo-item';
                    
                    const isSelected = selectedConvo && 
                        ((selectedConvo.user_id && selectedConvo.user_id == convo.user_id) || 
                         (!selectedConvo.user_id && selectedConvo.session_id === convo.session_id));
                    
                    if (isSelected) {
                        item.classList.add('active');
                    }

                    const timeStr = convo.last_message_at ? formatTime(convo.last_message_at) : '';
                    const avatarChar = convo.name.substring(0, 1).toUpperCase();
                    
                    item.innerHTML = `
                        <div class="convo-avatar">${avatarChar}</div>
                        <div class="convo-info">
                            <div class="convo-header">
                                <span class="convo-name">${convo.name}</span>
                                <span class="convo-time">${timeStr}</span>
                            </div>
                            <div class="convo-preview">${convo.latest_message_sender === 'admin' ? 'Bạn: ' : ''}${convo.latest_message}</div>
                        </div>
                    `;

                    if (convo.is_unread && !isSelected) {
                        const badge = document.createElement('div');
                        badge.className = 'unread-indicator';
                        item.appendChild(badge);
                    }

                    item.addEventListener('click', () => {
                        selectConversation(convo);
                    });

                    convoListWrapper.appendChild(item);
                });
            }

            function selectConversation(convo) {
                selectedConvo = convo;
                
                // Switch active class in UI list
                document.querySelectorAll('.convo-item').forEach(el => el.classList.remove('active'));
                loadConversations(); // Reload list to mark active & clear unread indicator
                
                // Show active chat window
                noChatScreen.style.display = 'none';
                chatActiveScreen.style.display = 'flex';
                
                activeUserTitle.innerText = convo.name;
                activeUserSubtitle.innerText = convo.user_id ? `${convo.email}` : `Chưa đăng nhập • ID: ${convo.session_id}`;
                updateAiToggleUI(convo.is_ai_enabled);
                
                // Clear and load messages
                activeMessagesContainer.innerHTML = '';
                currentMessagesCount = 0;
                loadConversationMessages();
                
                // Clear any existing polling interval
                if (messagesPoll) clearInterval(messagesPoll);
                // Start polling messages for active conversation
                messagesPoll = setInterval(loadConversationMessages, 3000);
            }

            function loadConversationMessages() {
                if (!selectedConvo) return;
                
                const userIdParam = selectedConvo.user_id ? `user_id=${selectedConvo.user_id}` : `user_id=null`;
                const sessionParam = selectedConvo.session_id ? `session_id=${selectedConvo.session_id}` : '';
                
                fetch(`/admin/api/chat/conversation/messages?${userIdParam}&${sessionParam}`)
                    .then(res => res.json())
                    .then(messages => {
                        if (messages.length > currentMessagesCount) {
                            activeMessagesContainer.innerHTML = '';
                            messages.forEach(msg => {
                                appendMessageUI(msg.sender, msg.message, msg.created_at);
                            });
                            
                            currentMessagesCount = messages.length;
                            activeMessagesContainer.scrollTop = activeMessagesContainer.scrollHeight;
                        }
                    })
                    .catch(err => console.error(err));
            }

            function appendMessageUI(sender, text, timeStr) {
                const wrapper = document.createElement('div');
                wrapper.className = 'msg-bubble-wrapper ' + sender + '-sender';
                
                const time = timeStr ? formatTime(timeStr) : '';
                
                let contentHtml = `<div>${escapeHtml(text)}</div>`;
                if (text.startsWith('uploads/chats/')) {
                    contentHtml = `<img src="/${text}" style="max-width: 250px; max-height: 250px; border-radius: var(--radius-sm); display: block; cursor: pointer; margin-bottom: 0.25rem;" onclick="window.open('/${text}', '_blank')">`;
                }
                
                wrapper.innerHTML = `
                    <div class="msg-bubble" style="${text.startsWith('uploads/chats/') ? 'background: #f1f5f9; padding: 0.25rem; color: var(--text-main);' : ''}">
                        ${contentHtml}
                        <span class="msg-timestamp" style="${text.startsWith('uploads/chats/') ? 'color: var(--text-muted); padding: 0.25rem 0.5rem 0;' : ''}">${time}</span>
                    </div>
                `;
                activeMessagesContainer.appendChild(wrapper);
            }

            // Handle Admin image upload event listeners
            if (adminUploadBtn) {
                adminUploadBtn.addEventListener('click', function() {
                    adminFileInput.click();
                });
            }

            if (adminFileInput) {
                adminFileInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (!file || !selectedConvo) return;

                    if (!file.type.startsWith('image/')) {
                        alert('Vui lòng chỉ gửi hình ảnh!');
                        return;
                    }

                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('session_id', selectedConvo.session_id);
                    formData.append('user_id', selectedConvo.user_id);
                    formData.append('sender', 'admin');

                    fetch('/api/chat/upload', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        adminFileInput.value = '';
                        loadConversationMessages();
                        loadConversations();
                    })
                    .catch(err => {
                        console.error(err);
                        adminFileInput.value = '';
                    });
                });
            }

            // Handle reply submission
            chatReplyForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const replyText = replyTextInput.value.trim();
                if (!replyText || !selectedConvo) return;
                
                replyTextInput.value = '';
                
                // Append directly to UI first
                appendMessageUI('admin', replyText, new Date().toISOString());
                activeMessagesContainer.scrollTop = activeMessagesContainer.scrollHeight;
                currentMessagesCount++;
                
                // Send reply to API
                fetch('/admin/api/chat/conversation/reply', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        user_id: selectedConvo.user_id,
                        session_id: selectedConvo.session_id,
                        message: replyText
                    })
                })
                .then(res => res.json())
                .then(data => {
                    // Update latest message in convo list
                    loadConversations();
                })
                .catch(err => console.error(err));
            });

            function formatTime(isoStr) {
                const date = new Date(isoStr);
                return date.toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' }) + ' ' + date.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit' });
            }

            function escapeHtml(text) {
                return text
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }
        });
    </script>
</body>
</html>
