# SSOOauth2
Luồng xác thực:
User truy cập App, app kiểm tra xem đã tồn tại token chưa (lưu cookie), chưa có thì redirect về server xác thực (oauth), oauth sẽ xác thực user bằng tk, pass. 
Xác thực thành công oauth sẽ phát hành mã jwt giành cho app yêu cầu, chuyển hướng về App kèm token. App sẽ lưu token trong cookie để xác thực cho các request sau.
