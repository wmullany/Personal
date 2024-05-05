System Command Execution PHP Script to test websites against execution of system commands via HTTP requests

This PHP script allows the execution of system commands via HTTP requests. It takes a command as input via the "cmd" parameter in the URL and executes it on the server.

Usage:
1. Place the backup.php file on your web server.
2. Access the script via a web browser and append "?cmd=<command>" to the URL to execute system commands.

Security Considerations:
- Be extremely cautious when enabling system command execution via HTTP requests.
- Ensure that the script is securely configured and accessible only to authorized users.
- Implement proper input validation and sanitization to prevent command injection attacks.
