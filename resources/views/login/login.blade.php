<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Grocery POS</title>
  <script src="/_sdk/element_sdk.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
  <style>
        body {
            box-sizing: border-box;
        }
        
        .login-container {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            backdrop-filter: blur(10px);
        }
        
        .form-input {
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(22, 163, 74, 0.15);
        }
        
        .login-button {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            transition: all 0.3s ease;
        }
        
        .login-button:hover {
            background: linear-gradient(135deg, #15803d 0%, #166534 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(22, 163, 74, 0.3);
        }
        
        .login-button:active {
            transform: translateY(0);
        }
        
        .password-toggle {
            transition: all 0.2s ease;
        }
        
        .password-toggle:hover {
            background-color: #f0fdf4;
            color: #16a34a;
        }
        
        .logo-container {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            border-radius: 16px;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(22, 163, 74, 0.1) 0%, rgba(21, 128, 61, 0.05) 100%);
            animation: float 6s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 20%;
            right: 10%;
            animation-delay: 2s;
        }
        
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
        
        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            bottom: 10%;
            right: 20%;
            animation-delay: 1s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }
        
        .input-group {
            position: relative;
            margin-bottom: 24px;
        }
        
        .input-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .notification.success {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            border-left: 4px solid #22c55e;
            color: #166534;
        }
        
        .notification.error {
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
            border-left: 4px solid #ef4444;
            color: #dc2626;
        }
    </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
 </head>
 <body class="min-h-full bg-gradient-to-br from-slate-50 via-green-50 to-emerald-50 font-['Poppins']"><!-- Floating Background Shapes -->
  <div class="floating-shapes">
   <div class="shape"></div>
   <div class="shape"></div>
   <div class="shape"></div>
   <div class="shape"></div>
  </div><!-- Main Login Container -->
  <div class="min-h-screen flex items-center justify-center p-6 relative">
   <div class="login-container w-full max-w-md p-8"><!-- Logo Section -->
    <div class="text-center mb-8">
     <div class="logo-container w-20 h-20 mx-auto">
      <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
      </svg>
     </div>
     <h1 id="page-title" class="text-3xl font-bold text-gray-800 mb-2">Welcome Back</h1>
     <p id="page-subtitle" class="text-gray-600 font-medium">Sign in to your account</p>
    </div><!-- Login Form -->
    <form id="login-form" class="space-y-6"><!-- Email Input -->
     <div class="input-group"><label for="email" id="email-label" class="input-label">Email Address</label>
      <div class="relative"><input type="email" id="email" name="email" required class="form-input w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:outline-none text-gray-800 font-medium bg-white" placeholder="Enter your email address">
       <div class="absolute left-4 top-3.5">
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
        </svg>
       </div>
      </div>
     </div><!-- Password Input -->
     <div class="input-group"><label for="password" id="password-label" class="input-label">Password</label>
      <div class="relative"><input type="password" id="password" name="password" required class="form-input w-full px-4 py-3 pl-12 pr-12 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:outline-none text-gray-800 font-medium bg-white" placeholder="Enter your password">
       <div class="absolute left-4 top-3.5">
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
        </svg>
       </div><button type="button" id="toggle-password" class="password-toggle absolute right-4 top-3.5 p-1 rounded-lg text-gray-400 hover:text-green-600">
        <svg id="eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>
        <svg id="eye-closed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
        </svg></button>
      </div>
     </div><!-- Forgot Password Link -->
     <div class="text-right"><a href="#" id="forgot-password-link" class="text-sm font-medium text-green-600 hover:text-green-700 hover:underline transition-colors"> Forgot your password? </a>
     </div><!-- Login Button --> <button type="submit" class="login-button w-full py-3 px-6 text-white font-semibold rounded-xl shadow-lg"> <span id="login-button-text">Sign In</span> </button>
    </form><!-- Additional Links -->
    <div class="mt-8 text-center">
     <p class="text-sm text-gray-600">Don't have an account? <a href="#" class="font-medium text-green-600 hover:text-green-700 hover:underline transition-colors"> Sign up here </a></p>
    </div>
   </div>
  </div>
  <script>
        // Default configuration
        const defaultConfig = {
            page_title: "Welcome Back",
            page_subtitle: "Sign in to your account",
            email_label: "Email Address",
            password_label: "Password",
            login_button_text: "Sign In",
            forgot_password_text: "Forgot your password?",
            primary_color: "#16a34a",
            secondary_color: "#15803d",
            accent_color: "#22c55e",
            background_color: "#f0fdf4",
            text_color: "#166534",
            font_family: "Poppins",
            font_size: 16
        };

        // Element SDK implementation
        const element = {
            defaultConfig,
            render: async (config) => {
                // Update text content
                document.getElementById('page-title').textContent = config.page_title || defaultConfig.page_title;
                document.getElementById('page-subtitle').textContent = config.page_subtitle || defaultConfig.page_subtitle;
                document.getElementById('email-label').textContent = config.email_label || defaultConfig.email_label;
                document.getElementById('password-label').textContent = config.password_label || defaultConfig.password_label;
                document.getElementById('login-button-text').textContent = config.login_button_text || defaultConfig.login_button_text;
                document.getElementById('forgot-password-link').textContent = config.forgot_password_text || defaultConfig.forgot_password_text;

                // Apply colors
                const primaryColor = config.primary_color || defaultConfig.primary_color;
                const secondaryColor = config.secondary_color || defaultConfig.secondary_color;
                const accentColor = config.accent_color || defaultConfig.accent_color;
                const backgroundColor = config.background_color || defaultConfig.background_color;
                const textColor = config.text_color || defaultConfig.text_color;

                // Update background
                document.body.style.background = `linear-gradient(135deg, #f1f5f9 0%, ${backgroundColor} 50%, #ecfdf5 100%)`;

                // Update logo background
                const logoContainer = document.querySelector('.logo-container');
                logoContainer.style.background = `linear-gradient(135deg, ${primaryColor} 0%, ${secondaryColor} 100%)`;

                // Update button gradient
                const loginButton = document.querySelector('.login-button');
                loginButton.style.background = `linear-gradient(135deg, ${primaryColor} 0%, ${secondaryColor} 100%)`;

                // Update hover styles
                const style = document.createElement('style');
                style.textContent = `
                    .login-button:hover {
                        background: linear-gradient(135deg, ${secondaryColor} 0%, ${textColor} 100%) !important;
                    }
                    .form-input:focus {
                        border-color: ${primaryColor} !important;
                        box-shadow: 0 8px 25px ${primaryColor}25 !important;
                    }
                    .password-toggle:hover {
                        color: ${primaryColor} !important;
                    }
                `;
                
                // Remove existing style if any
                const existingStyle = document.getElementById('dynamic-styles');
                if (existingStyle) {
                    existingStyle.remove();
                }
                style.id = 'dynamic-styles';
                document.head.appendChild(style);

                // Apply font
                const customFont = config.font_family || defaultConfig.font_family;
                const baseFontStack = 'system-ui, -apple-system, sans-serif';
                document.body.style.fontFamily = `${customFont}, ${baseFontStack}`;

                // Apply font size scaling
                const baseSize = config.font_size || defaultConfig.font_size;
                document.getElementById('page-title').style.fontSize = `${baseSize * 1.875}px`;
                document.getElementById('page-subtitle').style.fontSize = `${baseSize}px`;
                document.getElementById('email-label').style.fontSize = `${baseSize * 0.875}px`;
                document.getElementById('password-label').style.fontSize = `${baseSize * 0.875}px`;
                document.getElementById('login-button-text').style.fontSize = `${baseSize}px`;
                document.getElementById('forgot-password-link').style.fontSize = `${baseSize * 0.875}px`;
            },
            mapToCapabilities: (config) => ({
                recolorables: [
                    {
                        get: () => config.primary_color || defaultConfig.primary_color,
                        set: (value) => {
                            config.primary_color = value;
                            window.elementSdk.setConfig({ primary_color: value });
                        }
                    },
                    {
                        get: () => config.secondary_color || defaultConfig.secondary_color,
                        set: (value) => {
                            config.secondary_color = value;
                            window.elementSdk.setConfig({ secondary_color: value });
                        }
                    },
                    {
                        get: () => config.accent_color || defaultConfig.accent_color,
                        set: (value) => {
                            config.accent_color = value;
                            window.elementSdk.setConfig({ accent_color: value });
                        }
                    },
                    {
                        get: () => config.background_color || defaultConfig.background_color,
                        set: (value) => {
                            config.background_color = value;
                            window.elementSdk.setConfig({ background_color: value });
                        }
                    },
                    {
                        get: () => config.text_color || defaultConfig.text_color,
                        set: (value) => {
                            config.text_color = value;
                            window.elementSdk.setConfig({ text_color: value });
                        }
                    }
                ],
                borderables: [],
                fontEditable: {
                    get: () => config.font_family || defaultConfig.font_family,
                    set: (value) => {
                        config.font_family = value;
                        window.elementSdk.setConfig({ font_family: value });
                    }
                },
                fontSizeable: {
                    get: () => config.font_size || defaultConfig.font_size,
                    set: (value) => {
                        config.font_size = value;
                        window.elementSdk.setConfig({ font_size: value });
                    }
                }
            }),
            mapToEditPanelValues: (config) => new Map([
                ["page_title", config.page_title || defaultConfig.page_title],
                ["page_subtitle", config.page_subtitle || defaultConfig.page_subtitle],
                ["email_label", config.email_label || defaultConfig.email_label],
                ["password_label", config.password_label || defaultConfig.password_label],
                ["login_button_text", config.login_button_text || defaultConfig.login_button_text],
                ["forgot_password_text", config.forgot_password_text || defaultConfig.forgot_password_text]
            ])
        };

        // Initialize Element SDK
        if (window.elementSdk) {
            window.elementSdk.init(element);
        }

        // Password visibility toggle functionality
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }

        // Form submission handler
        function handleLogin(event) {
            event.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // Basic validation
            if (!email || !password) {
                showNotification('Please fill in all fields', 'error');
                return;
            }
            
            if (!isValidEmail(email)) {
                showNotification('Please enter a valid email address', 'error');
                return;
            }
            
            if (password.length < 6) {
                showNotification('Password must be at least 6 characters', 'error');
                return;
            }
            
            // Simulate login process
            const loginButton = document.querySelector('.login-button');
            const buttonText = document.getElementById('login-button-text');
            const originalText = buttonText.textContent;
            
            // Show loading state
            loginButton.disabled = true;
            buttonText.textContent = 'Signing In...';
            loginButton.style.opacity = '0.7';
            
            // Simulate API call
            setTimeout(() => {
                // Reset button state
                loginButton.disabled = false;
                buttonText.textContent = originalText;
                loginButton.style.opacity = '1';
                
                // Show success message
                showNotification(`Welcome back! Logged in as ${email}`, 'success');
                
                // Clear form
                document.getElementById('login-form').reset();
            }, 2000);
        }

        // Email validation helper
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Notification system
        function showNotification(message, type) {
            // Remove existing notification if any
            const existingNotification = document.querySelector('.notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            
            const icon = type === 'success' ? 
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>' :
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
            
            notification.innerHTML = `
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        ${icon}
                    </svg>
                    <span class="font-medium">${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Show notification
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            // Hide notification after 4 seconds
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 4000);
        }

        // Event listeners
        document.getElementById('toggle-password').addEventListener('click', togglePasswordVisibility);
        document.getElementById('login-form').addEventListener('submit', handleLogin);
        
        // Forgot password link handler
        document.getElementById('forgot-password-link').addEventListener('click', (e) => {
            e.preventDefault();
            showNotification('Password reset link would be sent to your email', 'success');
        });

        // Input focus effects
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', () => {
                input.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'992e5fdc7252ec19',t:'MTc2MTE5MjUxOS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>