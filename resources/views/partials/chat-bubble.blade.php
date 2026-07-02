<!-- Floating Chat Bubble Widget -->
<div id="floating-chat-widget" style="position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 1000; font-family: 'Inter', sans-serif;">
    
    <!-- Unread Badge -->
    <div id="chat-unread-badge" style="display: none; position: absolute; top: -5px; right: -5px; background: #ef4444; color: white; font-size: 0.72rem; font-weight: 800; padding: 0.15rem 0.4rem; border-radius: 99px; border: 2px solid white; box-shadow: var(--shadow-sm); z-index: 2;">0</div>

    <!-- Bubble Button -->
    <button id="chat-bubble-btn" style="width: 3.5rem; height: 3.5rem; border-radius: 50%; background: linear-gradient(135deg, var(--secondary), var(--primary)); color: white; border: none; cursor: pointer; box-shadow: 0 10px 25px rgba(2, 132, 199, 0.4); display: flex; align-items: center; justify-content: center; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); outline: none; font-size: 1.5rem;">
        <i class="fa-solid fa-comments" id="chat-icon-msg"></i>
        <i class="fa-solid fa-xmark" id="chat-icon-close" style="display: none; font-size: 1.3rem;"></i>
    </button>

    <!-- Chat Box Window -->
    <div id="chat-box-window" style="display: none; position: absolute; bottom: 4.2rem; right: 0; width: 350px; height: 480px; background: #ffffff; border-radius: var(--radius-lg); box-shadow: 0 12px 40px rgba(15, 23, 42, 0.15); border: 1px solid var(--border-color); flex-direction: column; overflow: hidden; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); transform: translateY(20px); opacity: 0; display: none;">
        
        <!-- Header -->
        <div style="background: linear-gradient(135deg, var(--secondary), var(--primary)); color: white; padding: 1rem 1.25rem; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="position: relative; width: 2.2rem; height: 2.2rem; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; border: 1px solid rgba(255, 255, 255, 0.3);">
                    AI
                    <span style="position: absolute; bottom: 1px; right: 1px; width: 8px; height: 8px; background: #22c55e; border-radius: 50%; border: 1px solid white;"></span>
                </div>
                <div>
                    <h4 style="margin: 0; font-size: 0.9rem; font-weight: 800;">Hỗ Trợ AI CỦA TÔI</h4>
                    <span style="font-size: 0.7rem; color: rgba(255, 255, 255, 0.85); display: flex; align-items: center; gap: 0.25rem;"><span style="display: inline-block; width: 5px; height: 5px; background: #22c55e; border-radius: 50%;"></span> Trực tuyến 24/7</span>
                </div>
            </div>
            
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <a href="https://zalo.me/0569012134" target="_blank" title="Chat Zalo" style="color: white; font-size: 1.05rem; opacity: 0.9; transition: opacity 0.2s;"><i class="fa-solid fa-phone"></i></a>
                <a href="https://t.me/specademy" target="_blank" title="Chat Telegram" style="color: white; font-size: 1.05rem; opacity: 0.9; transition: opacity 0.2s; margin-left: 0.25rem;"><i class="fa-brands fa-telegram"></i></a>
            </div>
        </div>

        <!-- Chat Area -->
        <div id="chat-messages-area" style="flex: 1; padding: 1.25rem; overflow-y: auto; background: #f8fafc; display: flex; flex-direction: column; gap: 0.75rem;">
            <!-- Welcome message -->
            <div class="chat-msg-row admin-msg" style="display: flex; justify-content: flex-start;">
                <div style="max-width: 80%; background: #e2e8f0; color: #0f172a; padding: 0.65rem 0.85rem; border-radius: 0.25rem 1rem 1rem 1rem; font-size: 0.82rem; line-height: 1.45; box-shadow: var(--shadow-sm);">
                    Chào bạn! Tôi có thể giúp gì cho bạn? Để được hỗ trợ kích hoạt nhanh nhất, bạn cũng có thể liên hệ trực tiếp qua Zalo <strong>0569012134</strong> nhé!
                </div>
            </div>
        </div>

        <!-- Typing Indicator -->
        <div id="chat-typing-indicator" style="display: none; padding: 0.5rem 1.25rem; background: #f8fafc; font-size: 0.75rem; color: #64748b;">
            <div style="display: flex; align-items: center; gap: 0.35rem;">
                <span>Hỗ trợ viên đang soạn tin</span>
                <span class="typing-dot" style="animation: typing-bouncy 1.4s infinite 0.2s; display: inline-block; width: 4px; height: 4px; background: #64748b; border-radius: 50%;"></span>
                <span class="typing-dot" style="animation: typing-bouncy 1.4s infinite 0.4s; display: inline-block; width: 4px; height: 4px; background: #64748b; border-radius: 50%;"></span>
                <span class="typing-dot" style="animation: typing-bouncy 1.4s infinite 0.6s; display: inline-block; width: 4px; height: 4px; background: #64748b; border-radius: 50%;"></span>
            </div>
        </div>

        <!-- Mode Options Bar -->
        <div style="background: #f1f5f9; padding: 0.4rem 0.75rem; border-top: 1px solid var(--border-color); display: flex; gap: 0.5rem; justify-content: space-between; align-items: center; flex-shrink: 0; user-select: none;">
            <div id="ai-status-pill" style="font-size: 0.72rem; display: flex; align-items: center; gap: 0.25rem; font-weight: 700; color: #0284c7; background: rgba(2, 132, 199, 0.1); padding: 0.2rem 0.5rem; border-radius: var(--radius-sm);">
                <i class="fa-solid fa-robot"></i> AI đang trả lời
            </div>
            <button type="button" id="call-admin-btn" style="background: #ef4444; color: white; border: none; font-size: 0.72rem; font-weight: 700; padding: 0.25rem 0.6rem; border-radius: var(--radius-sm); cursor: pointer; display: flex; align-items: center; gap: 0.25rem; transition: opacity 0.2s; outline: none;">
                <i class="fa-solid fa-paper-plane"></i> Nhắn Admin
            </button>
        </div>

        <!-- Footer / Input Form -->
        <form id="chat-input-form" style="display: flex; border-top: 1px solid var(--border-color); padding: 0.75rem; background: #ffffff; gap: 0.5rem; align-items: center; margin: 0;">
            <input type="file" id="chat-file-input" accept="image/*" style="display: none;">
            <button type="button" id="chat-upload-btn" style="background: #f1f5f9; border: 1px solid var(--border-color); color: #64748b; width: 2.2rem; height: 2.2rem; border-radius: var(--radius-md); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s; font-size: 0.9rem;" title="Gửi hình ảnh">
                <i class="fa-solid fa-camera"></i>
            </button>
            <input type="text" id="chat-user-message" placeholder="Nhập tin nhắn..." autocomplete="off" style="flex: 1; border: 1px solid var(--border-color); padding: 0.55rem 0.85rem; border-radius: var(--radius-md); font-size: 0.85rem; outline: none; background: #ffffff; color: var(--text-main); font-family: inherit;">
            <button type="submit" style="background: var(--primary); border: none; color: white; width: 2.2rem; height: 2.2rem; border-radius: var(--radius-md); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; font-size: 0.9rem;">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </form>
    </div>
</div>

<style>
    @keyframes typing-bouncy {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }
    
    #chat-bubble-btn:hover {
        transform: scale(1.08);
    }
    
    #chat-bubble-btn:active {
        transform: scale(0.95);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatBubbleBtn = document.getElementById('chat-bubble-btn');
    const chatBoxWindow = document.getElementById('chat-box-window');
    const chatIconMsg = document.getElementById('chat-icon-msg');
    const chatIconClose = document.getElementById('chat-icon-close');
    const chatInputForm = document.getElementById('chat-input-form');
    const chatUserMessage = document.getElementById('chat-user-message');
    const chatMessagesArea = document.getElementById('chat-messages-area');
    const chatTypingIndicator = document.getElementById('chat-typing-indicator');
    const chatUnreadBadge = document.getElementById('chat-unread-badge');
    const callAdminBtn = document.getElementById('call-admin-btn');
    const aiStatusPill = document.getElementById('ai-status-pill');
    const chatFileInput = document.getElementById('chat-file-input');
    const chatUploadBtn = document.getElementById('chat-upload-btn');
    
    let isChatOpen = false;
    let lastMessageCount = 0;
    let isAiEnabled = true;
    
    // Web Audio Synthesizer for 100% reliable local sound notifications (No CORS / network lag)
    function playNotificationSound() {
        try {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            if (!AudioContext) return;
            const audioCtx = new AudioContext();
            
            const oscillator = audioCtx.createOscillator();
            const gainNode = audioCtx.createGain();
            
            oscillator.connect(gainNode);
            gainNode.connect(audioCtx.destination);
            
            oscillator.type = 'sine';
            oscillator.frequency.setValueAtTime(587.33, audioCtx.currentTime); // D5
            oscillator.frequency.exponentialRampToValueAtTime(880.00, audioCtx.currentTime + 0.08); // slide to A5
            
            gainNode.gain.setValueAtTime(0.15, audioCtx.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.35); // decay
            
            oscillator.start();
            oscillator.stop(audioCtx.currentTime + 0.35);
        } catch (e) {
            console.log('Audio play blocked/failed:', e);
        }
    }
    
    // Persistent Session ID for guest identification
    let sessionId = localStorage.getItem('chat_session_id');
    if (!sessionId) {
        sessionId = 'session_' + Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        localStorage.setItem('chat_session_id', sessionId);
    }

    // Toggle Chat Window
    chatBubbleBtn.addEventListener('click', function() {
        isChatOpen = !isChatOpen;
        if (isChatOpen) {
            chatBoxWindow.style.display = 'flex';
            setTimeout(() => {
                chatBoxWindow.style.transform = 'translateY(0)';
                chatBoxWindow.style.opacity = '1';
            }, 10);
            chatIconMsg.style.display = 'none';
            chatIconClose.style.display = 'block';
            chatUnreadBadge.style.display = 'none';
            chatUnreadBadge.innerText = '0';
            
            // Initial load of messages (will mark as read since isChatOpen is true)
            loadMessages();
            
            // Scroll to bottom
            setTimeout(scrollToBottom, 100);
        } else {
            chatBoxWindow.style.transform = 'translateY(20px)';
            chatBoxWindow.style.opacity = '0';
            setTimeout(() => {
                chatBoxWindow.style.display = 'none';
            }, 300);
            chatIconMsg.style.display = 'block';
            chatIconClose.style.display = 'none';
            
            // Reload to recalculate unread badge for closed state
            loadMessages();
        }
    });

    // Handle Call Admin Alert
    if (callAdminBtn) {
        callAdminBtn.addEventListener('click', function() {
            callAdminBtn.disabled = true;
            callAdminBtn.style.opacity = '0.5';
            
            chatTypingIndicator.style.display = 'block';
            scrollToBottom();
            
            fetch('/api/chat/call-admin', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    session_id: sessionId
                })
            })
            .then(res => res.json())
            .then(data => {
                chatTypingIndicator.style.display = 'none';
                loadMessages();
            })
            .catch(err => {
                console.error(err);
                callAdminBtn.disabled = false;
                callAdminBtn.style.opacity = '1';
                chatTypingIndicator.style.display = 'none';
            });
        });
    }

    // Handle Form Submission
    chatInputForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const text = chatUserMessage.value.trim();
        if (!text) return;
        
        chatUserMessage.value = '';
        
        // Append user message immediately to UI
        appendMessage('user', text);
        scrollToBottom();
        
        if (isAiEnabled) {
            chatTypingIndicator.style.display = 'block';
            scrollToBottom();
        }
        
        // Send to server
        fetch('/api/chat/messages', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                message: text,
                session_id: sessionId
            })
        })
        .then(res => res.json())
        .then(data => {
            chatTypingIndicator.style.display = 'none';
            loadMessages();
        })
        .catch(err => {
            console.error(err);
            chatTypingIndicator.style.display = 'none';
        });
    });

    // Handle File Upload Event listeners
    if (chatUploadBtn) {
        chatUploadBtn.addEventListener('click', function() {
            chatFileInput.click();
        });
    }

    if (chatFileInput) {
        chatFileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('Vui lòng chỉ gửi hình ảnh!');
                return;
            }

            const formData = new FormData();
            formData.append('image', file);
            formData.append('session_id', sessionId);
            formData.append('sender', 'user');

            chatTypingIndicator.style.display = 'block';
            scrollToBottom();

            fetch('/api/chat/upload', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                chatFileInput.value = '';
                chatTypingIndicator.style.display = 'none';
                loadMessages();
            })
            .catch(err => {
                console.error(err);
                chatFileInput.value = '';
                chatTypingIndicator.style.display = 'none';
            });
        });
    }

    function loadMessages() {
        fetch(`/api/chat/messages?session_id=${sessionId}&mark_read=${isChatOpen}`)
            .then(res => res.json())
            .then(data => {
                const messages = data.messages || [];
                isAiEnabled = data.is_ai_enabled !== undefined ? data.is_ai_enabled : true;
                
                // Update AI status UI state
                if (isAiEnabled) {
                    aiStatusPill.innerHTML = '<i class="fa-solid fa-robot"></i> AI đang trả lời';
                    aiStatusPill.style.color = '#0284c7';
                    aiStatusPill.style.background = 'rgba(2, 132, 199, 0.1)';
                    callAdminBtn.style.display = 'flex';
                    callAdminBtn.disabled = false;
                    callAdminBtn.style.opacity = '1';
                } else {
                    aiStatusPill.innerHTML = '<i class="fa-solid fa-user-tie"></i> Admin tiếp nhận';
                    aiStatusPill.style.color = '#d97706';
                    aiStatusPill.style.background = 'rgba(217, 119, 6, 0.1)';
                    callAdminBtn.style.display = 'none';
                }

                // Clear old messages (but keep the default welcome message if empty)
                const defaultMsg = chatMessagesArea.firstElementChild;
                chatMessagesArea.innerHTML = '';
                if (defaultMsg) chatMessagesArea.appendChild(defaultMsg);
                
                let unreadCount = 0;
                messages.forEach(msg => {
                    appendMessage(msg.sender, msg.message);
                    if (msg.sender === 'admin' && !msg.is_read) {
                        unreadCount++;
                    }
                });
                
                // Show unread indicator if closed
                if (!isChatOpen && unreadCount > 0) {
                    chatUnreadBadge.style.display = 'block';
                    chatUnreadBadge.innerText = unreadCount;
                } else {
                    chatUnreadBadge.style.display = 'none';
                    chatUnreadBadge.innerText = '0';
                }
                
                // Check if we should play a sound (only when new message arrives and it is from admin)
                if (lastMessageCount > 0 && messages.length > lastMessageCount) {
                    const latestMsg = messages[messages.length - 1];
                    if (latestMsg.sender === 'admin') {
                        playNotificationSound();
                    }
                }
                
                // If there are new messages, scroll to bottom
                if (messages.length > lastMessageCount) {
                    scrollToBottom();
                }
                lastMessageCount = messages.length;
            })
            .catch(err => console.error(err));
    }

    function appendMessage(sender, text) {
        const row = document.createElement('div');
        row.className = 'chat-msg-row ' + sender + '-msg';
        row.style.display = 'flex';
        row.style.justifyContent = sender === 'user' ? 'flex-end' : 'flex-start';
        
        const bubble = document.createElement('div');
        bubble.style.maxWidth = '80%';
        bubble.style.padding = '0.65rem 0.85rem';
        bubble.style.fontSize = '0.82rem';
        bubble.style.lineHeight = '1.45';
        bubble.style.boxShadow = '0 1px 2px rgba(0,0,0,0.05)';
        
        if (sender === 'user') {
            bubble.style.background = 'var(--primary)';
            bubble.style.color = '#ffffff';
            bubble.style.borderRadius = '1rem 1rem 0.25rem 1rem';
        } else {
            bubble.style.background = '#e2e8f0';
            bubble.style.color = '#0f172a';
            bubble.style.borderRadius = '0.25rem 1rem 1rem 1rem';
        }
        
        if (text.startsWith('uploads/chats/')) {
            bubble.style.padding = '0.25rem';
            bubble.style.background = '#f1f5f9';
            bubble.innerHTML = `<img src="/${text}" style="max-width: 100%; max-height: 180px; border-radius: var(--radius-md); display: block; cursor: pointer;" onclick="window.open('/${text}', '_blank')">`;
        } else {
            bubble.innerHTML = escapeHtml(text);
        }
        
        row.appendChild(bubble);
        chatMessagesArea.appendChild(row);
    }

    function scrollToBottom() {
        chatMessagesArea.scrollTop = chatMessagesArea.scrollHeight;
    }

    function escapeHtml(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;")
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>'); // simple bold parser
    }
    
    // Dynamic binding for Footer Modals
    const modalOverlay = document.getElementById('footer-modal-overlay');
    const modalTitle = document.getElementById('footer-modal-title');
    const modalBody = document.getElementById('footer-modal-body');
    const modalClose = document.getElementById('footer-modal-close');

    const modalContents = {
        warranty: `
            <h4 style="color: var(--primary, #0284c7); font-weight: 700; margin-bottom: 0.75rem; font-size: 0.95rem;"><i class="fa-solid fa-shield-halved"></i> 1. Thời Gian Bảo Hành</h4>
            <p style="margin-bottom: 1.25rem;">Tất cả các tài khoản số (CapCut Pro, ChatGPT Plus, Canva Pro, Gemini Advanced, Claude Pro, Microsoft Office 365) đều được cam kết bảo hành trọn vẹn trong suốt thời gian của gói dịch vụ bạn đăng ký mua (1 tháng, 6 tháng, 1 năm, hoặc vĩnh viễn).</p>

            <h4 style="color: var(--primary, #0284c7); font-weight: 700; margin-bottom: 0.75rem; font-size: 0.95rem;"><i class="fa-solid fa-circle-check"></i> 2. Chính Sách 1 Đổi 1</h4>
            <p style="margin-bottom: 1.25rem;">Nếu tài khoản gặp sự cố mất tính năng VIP/Pro hoặc lỗi đăng nhập do nhà sản xuất, chúng tôi hỗ trợ khắc phục hoặc đổi tài khoản mới siêu tốc từ 30 giây đến tối đa 12 giờ làm việc.</p>

            <h4 style="color: var(--primary, #0284c7); font-weight: 700; margin-bottom: 0.75rem; font-size: 0.95rem;"><i class="fa-solid fa-triangle-exclamation"></i> 3. Trường Hợp Từ Chối Bảo Hành</h4>
            <ul style="padding-left: 1.25rem; margin-bottom: 1.25rem; list-style-type: disc; display: flex; flex-direction: column; gap: 0.35rem;">
                <li>Khách hàng tự ý thay đổi thông tin email, mật khẩu gốc đối với tài khoản dùng chung.</li>
                <li>Chia sẻ tài khoản cá nhân cho quá nhiều thiết bị cùng lúc làm khóa tài khoản.</li>
                <li>Sử dụng dịch vụ cho mục đích gian lận hoặc vi phạm chính sách pháp luật Việt Nam.</li>
            </ul>

            <h4 style="color: var(--primary, #0284c7); font-weight: 700; margin-bottom: 0.75rem; font-size: 0.95rem;"><i class="fa-solid fa-headset"></i> 4. Cách thức bảo hành</h4>
            <p style="margin: 0;">Quý khách vui lòng nhắn tin trực tiếp qua nút <strong>Nhắn Admin</strong> ở góc màn hình hoặc liên hệ Zalo: <strong>0569012134</strong> để được xử lý nhanh nhất.</p>
        `,
        terms: `
            <h4 style="color: var(--primary, #0284c7); font-weight: 700; margin-bottom: 0.75rem; font-size: 0.95rem;"><i class="fa-solid fa-file-contract"></i> 1. Chấp Thuận Điều Khoản</h4>
            <p style="margin-bottom: 1.25rem;">Khi sử dụng dịch vụ và thực hiện giao dịch trên website <strong>AI CỦA TÔI</strong>, quý khách mặc nhiên đồng ý tuân thủ toàn bộ các quy định sử dụng và cam kết dịch vụ của chúng tôi.</p>

            <h4 style="color: var(--primary, #0284c7); font-weight: 700; margin-bottom: 0.75rem; font-size: 0.95rem;"><i class="fa-solid fa-user-lock"></i> 2. Bảo Mật & Sử Dụng Tài Khoản</h4>
            <ul style="padding-left: 1.25rem; margin-bottom: 1.25rem; list-style-type: disc; display: flex; flex-direction: column; gap: 0.35rem;">
                <li><strong>Gói Email Chính Chủ:</strong> Nâng cấp trực tiếp trên Email của khách hàng. Khách có nghĩa vụ tự bảo vệ tài khoản cá nhân của mình.</li>
                <li><strong>Gói Dùng Chung (Shared):</strong> Khách hàng tuyệt đối không được đổi mật khẩu, chia sẻ hoặc bán lại thông tin đăng nhập cho bên thứ ba.</li>
            </ul>

            <h4 style="color: var(--primary, #0284c7); font-weight: 700; margin-bottom: 0.75rem; font-size: 0.95rem;"><i class="fa-solid fa-credit-card"></i> 3. Quy Định Thanh Toán</h4>
            <p style="margin-bottom: 1.25rem;">Quý khách thực hiện chuyển khoản ngân hàng qua mã QR. Đơn hàng sẽ được kích hoạt tự động qua cổng SePay ngay khi hệ thống nhận được giao dịch thành công.</p>

            <h4 style="color: var(--primary, #0284c7); font-weight: 700; margin-bottom: 0.75rem; font-size: 0.95rem;"><i class="fa-solid fa-ban"></i> 4. Thay Đổi Điều Khoản</h4>
            <p style="margin: 0;">AI CỦA TÔI có quyền cập nhật, bổ sung các điều khoản sử dụng này bất cứ lúc nào để phù hợp với quy định của các hãng cung cấp (như OpenAI, Canva, Google, CapCut).</p>
        `,
        guide: `
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div style="display: flex; gap: 0.75rem; align-items: flex-start;">
                    <div style="background: var(--primary, #0284c7); color: white; width: 1.8rem; height: 1.8rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0; font-size: 0.85rem;">1</div>
                    <div>
                        <h5 style="margin: 0 0 0.25rem; font-weight: 700; font-size: 0.9rem; color: #1e293b;">Bước 1: Chọn gói sản phẩm</h5>
                        <p style="margin: 0; color: #64748b; font-size: 0.82rem;">Lựa chọn sản phẩm (ví dụ: CapCut Pro), chọn gói thời hạn phù hợp (1 tháng, 6 tháng, 1 năm,...) rồi bấm <strong>Thêm vào giỏ hàng</strong>.</p>
                    </div>
                </div>

                <div style="display: flex; gap: 0.75rem; align-items: flex-start;">
                    <div style="background: var(--primary, #0284c7); color: white; width: 1.8rem; height: 1.8rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0; font-size: 0.85rem;">2</div>
                    <div>
                        <h5 style="margin: 0 0 0.25rem; font-weight: 700; font-size: 0.9rem; color: #1e293b;">Bước 2: Điền thông tin giao hàng</h5>
                        <p style="margin: 0; color: #64748b; font-size: 0.82rem;">Mở giỏ hàng, điền đầy đủ Email (để nâng cấp chính chủ) và Số điện thoại nhận tài khoản.</p>
                    </div>
                </div>

                <div style="display: flex; gap: 0.75rem; align-items: flex-start;">
                    <div style="background: var(--primary, #0284c7); color: white; width: 1.8rem; height: 1.8rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0; font-size: 0.85rem;">3</div>
                    <div>
                        <h5 style="margin: 0 0 0.25rem; font-weight: 700; font-size: 0.9rem; color: #1e293b;">Bước 3: Quét mã QR thanh toán</h5>
                        <p style="margin: 0; color: #64748b; font-size: 0.82rem;">Quét mã QR hiển thị trên màn hình thanh toán để chuyển khoản đúng số tiền và nội dung chuyển khoản tự động.</p>
                    </div>
                </div>

                <div style="display: flex; gap: 0.75rem; align-items: flex-start;">
                    <div style="background: var(--primary, #0284c7); color: white; width: 1.8rem; height: 1.8rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0; font-size: 0.85rem;">4</div>
                    <div>
                        <h5 style="margin: 0 0 0.25rem; font-weight: 700; font-size: 0.9rem; color: #1e293b;">Bước 4: Nhận tài khoản & Sử dụng</h5>
                        <p style="margin: 0; color: #64748b; font-size: 0.82rem;">Hệ thống SePay quét giao dịch thành công sẽ kích hoạt gói VIP hoặc gửi thông tin tài khoản qua Email và Zalo của bạn trong 30 giây.</p>
                    </div>
                </div>
            </div>
        `
    };

    function openFooterModal(type) {
        if (!modalOverlay || !modalContents[type]) return;
        
        let title = '';
        if (type === 'warranty') title = 'CHÍNH SÁCH BẢO HÀNH';
        if (type === 'terms') title = 'ĐIỀU KHOẢN SỬ DỤNG';
        if (type === 'guide') title = 'HƯỚNG DẪN MUA HÀNG';

        modalTitle.innerText = title;
        modalBody.innerHTML = modalContents[type];
        
        modalOverlay.style.display = 'flex';
        setTimeout(() => {
            modalOverlay.style.opacity = '1';
            const card = document.getElementById('footer-modal-card');
            if (card) card.style.transform = 'scale(1)';
        }, 10);
    }

    function closeFooterModal() {
        if (!modalOverlay) return;
        modalOverlay.style.opacity = '0';
        const card = document.getElementById('footer-modal-card');
        if (card) card.style.transform = 'scale(0.95)';
        setTimeout(() => {
            modalOverlay.style.display = 'none';
        }, 300);
    }

    if (modalClose) {
        modalClose.addEventListener('click', closeFooterModal);
    }
    if (modalOverlay) {
        modalOverlay.addEventListener('click', function(e) {
            if (e.target === modalOverlay) {
                closeFooterModal();
            }
        });
    }

    // Scan the page for links with matching text dynamically
    function bindDynamicModalLinks() {
        document.querySelectorAll('a').forEach(a => {
            const text = a.textContent.trim().toLowerCase();
            if (text === 'chính sách bảo hành') {
                a.removeAttribute('href');
                a.style.cursor = 'pointer';
                a.addEventListener('click', function(e) {
                    e.preventDefault();
                    openFooterModal('warranty');
                });
            } else if (text === 'điều khoản sử dụng') {
                a.removeAttribute('href');
                a.style.cursor = 'pointer';
                a.addEventListener('click', function(e) {
                    e.preventDefault();
                    openFooterModal('terms');
                });
            } else if (text === 'hướng dẫn mua hàng') {
                a.removeAttribute('href');
                a.style.cursor = 'pointer';
                a.addEventListener('click', function(e) {
                    e.preventDefault();
                    openFooterModal('guide');
                });
            }
        });
    }

    bindDynamicModalLinks();

    // Check initial unread messages count on load
    loadMessages();
    
    // Poll constantly in the background every 5 seconds
    setInterval(loadMessages, 5000);
});
</script>

<!-- Footer Policies Modals Container -->
<div id="footer-modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); z-index: 10000; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;">
    <div id="footer-modal-card" style="background: #ffffff; width: 90%; max-width: 550px; max-height: 80vh; border-radius: 16px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); display: flex; flex-direction: column; overflow: hidden; transform: scale(0.95); transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
        <!-- Header -->
        <div style="padding: 1rem 1.25rem; background: linear-gradient(135deg, var(--secondary, #0284c7), var(--primary, #0369a1)); color: white; display: flex; align-items: center; justify-content: space-between;">
            <h3 id="footer-modal-title" style="margin: 0; font-size: 0.95rem; font-weight: 800; letter-spacing: 0.5px;">TIÊU ĐỀ</h3>
            <button id="footer-modal-close" style="background: none; border: none; color: white; font-size: 1.2rem; cursor: pointer; opacity: 0.9; transition: opacity 0.2s; outline: none; display: flex; align-items: center; justify-content: center; width: 1.8rem; height: 1.8rem; border-radius: 50%;"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <!-- Body -->
        <div id="footer-modal-body" style="padding: 1.5rem; overflow-y: auto; font-size: 0.85rem; line-height: 1.55; color: #334155; font-family: inherit;">
            <!-- Injected Content -->
        </div>
    </div>
</div>
