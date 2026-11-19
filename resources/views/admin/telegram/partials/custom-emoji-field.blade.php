<div class="form-group" style="margin-bottom: 1.25rem; padding: 1rem; border: 1px solid #bae6fd; border-radius: 8px; background: #f0f9ff;">
    <label class="form-label" for="{{ $prefix }}_cat_custom_emoji_id">Icon Telegram — Custom Emoji ID</label>
    <input type="text" name="telegram_custom_emoji_id" id="{{ $prefix }}_cat_custom_emoji_id"
        class="form-input" inputmode="numeric" pattern="[1-9][0-9]{0,19}" maxlength="20"
        value="{{ old('telegram_custom_emoji_id') }}" placeholder="Dán ID của emoji/logo tùy chỉnh">
    <small style="display: block; margin-top: 0.5rem; line-height: 1.6; color: #475569;">
        Icon tùy chỉnh sẽ thay emoji mặc định trên nút danh mục. Tài khoản chủ bot cần Telegram Premium hoặc bot có username mua qua Fragment.
        Gửi <code>/emojiid</code> kèm emoji tùy chỉnh cho bot, hoặc trả lời tin nhắn có emoji đó bằng <code>/emojiid</code>, rồi dán ID bot trả về vào đây.
        Để trống để dùng emoji dự phòng. Logo SVG/ảnh trên web không dùng trực tiếp được trên nút Telegram.
    </small>
    <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-top: 0.75rem;">
        <a href="https://t.me/addemoji/Ai_Complex" target="_blank" rel="noopener noreferrer">Xem bộ logo AI</a>
        <a href="https://t.me/addemoji/LogosEmoji2025" target="_blank" rel="noopener noreferrer">Xem bộ logo ứng dụng</a>
    </div>
</div>
