
      // Configuration object
      const defaultConfig = {
        page_title: "UI Elements Showcase",
        showcase_subtitle:
          "Explore our comprehensive collection of beautifully designed UI components with various sizes and styles",
      };

      let sidebarVisible = true;
      let isDarkMode = false;

      // Element SDK implementation
      const element = {
        defaultConfig: defaultConfig,
        onConfigChange: async (config) => {
          const pageTitleEl = document.getElementById("page-title");
          if (pageTitleEl) {
            pageTitleEl.textContent =
              config.page_title || defaultConfig.page_title;
          }

          const showcaseSubtitleEl =
            document.getElementById("showcase-subtitle");
          if (showcaseSubtitleEl) {
            showcaseSubtitleEl.textContent =
              config.showcase_subtitle || defaultConfig.showcase_subtitle;
          }
        },
        mapToCapabilities: function (config) {
          return {
            recolorables: [
              {
                get: function () {
                  return config.primary_color || "#10b981";
                },
                set: function (value) {
                  config.primary_color = value;
                  if (window.elementSdk) {
                    window.elementSdk.setConfig({ primary_color: value });
                  }
                },
              },
              {
                get: function () {
                  return config.background_color || "#f8fafc";
                },
                set: function (value) {
                  config.background_color = value;
                  if (window.elementSdk) {
                    window.elementSdk.setConfig({ background_color: value });
                  }
                },
              },
            ],
            borderables: [],
            fontEditable: {
              get: function () {
                return config.font_family || "system-ui";
              },
              set: function (value) {
                config.font_family = value;
                if (window.elementSdk) {
                  window.elementSdk.setConfig({ font_family: value });
                }
              },
            },
            fontSizeable: {
              get: function () {
                return config.font_size || 16;
              },
              set: function (value) {
                config.font_size = value;
                if (window.elementSdk) {
                  window.elementSdk.setConfig({ font_size: value });
                }
              },
            },
          };
        },
        mapToEditPanelValues: function (config) {
          return new Map([
            ["page_title", config.page_title || defaultConfig.page_title],
            [
              "showcase_subtitle",
              config.showcase_subtitle || defaultConfig.showcase_subtitle,
            ],
          ]);
        },
      };

      // Initialize Element SDK
      if (window.elementSdk) {
        window.elementSdk.init(element);
      }

      // Dark mode functionality
      function toggleDarkMode() {
        isDarkMode = !isDarkMode;
        const body = document.body;
        const icon = document.getElementById("dark-mode-icon");

        if (isDarkMode) {
          body.classList.add("dark");
          icon.className = "fas fa-sun text-lg";
          localStorage.setItem("darkMode", "true");
        } else {
          body.classList.remove("dark");
          icon.className = "fas fa-moon text-lg";
          localStorage.setItem("darkMode", "false");
        }
      }

      function initDarkMode() {
        const savedMode = localStorage.getItem("darkMode");
        if (savedMode === "true") {
          isDarkMode = true;
          document.body.classList.add("dark");
          document.getElementById("dark-mode-icon").className =
            "fas fa-sun text-lg";
        }
      }

      // POS Dropdown functionality
      function togglePOSDropdown() {
        const dropdown = document.getElementById("pos-dropdown");
        const arrow = document.getElementById("pos-arrow");

        dropdown.classList.toggle("hidden");

        if (dropdown.classList.contains("hidden")) {
          arrow.style.transform = "rotate(0deg)";
        } else {
          arrow.style.transform = "rotate(180deg)";
        }
      }

      function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.getElementById("main-content");
        const toggleBtn = document.getElementById("sidebar-toggle-btn");
        const toggleIcon = document.getElementById("sidebar-toggle-icon");
        const isMobile = window.innerWidth < 1024;

        sidebarVisible = !sidebarVisible;

        if (sidebarVisible) {
          sidebar.style.transform = "translateX(0)";
          toggleIcon.className = "fas fa-times text-lg";

          // Desktop: hide toggle button and adjust main content
          if (!isMobile) {
            toggleBtn.style.display = "none";
            mainContent.style.marginLeft = "0";
          } else {
            // Mobile: add overlay
            const overlay = document.createElement("div");
            overlay.id = "sidebar-overlay";
            overlay.className =
              "fixed inset-0 bg-black bg-opacity-50 z-10 lg:hidden";
            overlay.onclick = () => toggleSidebar();
            document.body.appendChild(overlay);
          }
        } else {
          sidebar.style.transform = "translateX(-100%)";
          toggleIcon.className = "fas fa-bars text-lg";

          // Desktop: show toggle button and make main content full width
          if (!isMobile) {
            toggleBtn.style.display = "block";
            mainContent.style.marginLeft = "0";
            mainContent.style.width = "100%";
          } else {
            // Remove overlay
            const overlay = document.getElementById("sidebar-overlay");
            if (overlay) overlay.remove();
          }
        }
      }

      // Handle window resize to maintain sidebar state
      function handleResize() {
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.getElementById("main-content");
        const toggleBtn = document.getElementById("sidebar-toggle-btn");
        const overlay = document.getElementById("sidebar-overlay");
        const toggleIcon = document.getElementById("sidebar-toggle-icon");
        const isMobile = window.innerWidth < 1024;

        if (!isMobile) {
          // Desktop mode - remove mobile overlay
          if (overlay) overlay.remove();

          if (sidebarVisible) {
            toggleBtn.style.display = "none";
            mainContent.style.marginLeft = "0";
          } else {
            toggleBtn.style.display = "block";
            mainContent.style.marginLeft = "0";
            mainContent.style.width = "100%";
          }
        } else {
          // Mobile mode - always show toggle button and reset main content styles
          toggleBtn.style.display = "block";
          mainContent.style.marginLeft = "";
          mainContent.style.width = "";

          if (sidebarVisible && !overlay) {
            const newOverlay = document.createElement("div");
            newOverlay.id = "sidebar-overlay";
            newOverlay.className =
              "fixed inset-0 bg-black bg-opacity-50 z-10 lg:hidden";
            newOverlay.onclick = () => toggleSidebar();
            document.body.appendChild(newOverlay);
          }
        }

        // Update sidebar transform and icon
        if (sidebarVisible) {
          sidebar.style.transform = "translateX(0)";
          toggleIcon.className = "fas fa-times text-lg";
        } else {
          sidebar.style.transform = "translateX(-100%)";
          toggleIcon.className = "fas fa-bars text-lg";
        }
      }

      // Add resize event listener
      window.addEventListener("resize", handleResize);

      // Custom dropdown functions
      function toggleDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        const menu = dropdown.querySelector(".custom-dropdown-menu");
        const isOpen = !menu.classList.contains("hidden");

        // Close all other dropdowns
        document.querySelectorAll(".custom-dropdown-menu").forEach((menu) => {
          menu.classList.add("hidden");
        });
        document.querySelectorAll(".custom-dropdown").forEach((dropdown) => {
          dropdown.classList.remove("open");
        });

        // Toggle current dropdown
        if (!isOpen) {
          menu.classList.remove("hidden");
          dropdown.classList.add("open");
        }
      }

      function selectDropdownItem(dropdownId, selectedId, value) {
        document.getElementById(selectedId).textContent = value;
        document.getElementById(dropdownId).classList.remove("open");
        document
          .querySelector(`#${dropdownId} .custom-dropdown-menu`)
          .classList.add("hidden");
      }

      function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        const dateString = now.toLocaleDateString("en-US", {
          weekday: "long",
          year: "numeric",
          month: "long",
          day: "numeric",
        });

        document.getElementById("current-time").textContent = timeString;
        document.getElementById("current-date").textContent = dateString;
      }

      function toggleNotifications() {
        const dropdown = document.getElementById("notification-dropdown");
        const profileDropdown = document.getElementById("profile-dropdown");

        // Close profile dropdown if open
        profileDropdown.classList.add("hidden");

        // Toggle notification dropdown
        dropdown.classList.toggle("hidden");
      }

      function toggleProfileMenu() {
        const dropdown = document.getElementById("profile-dropdown");
        const notificationDropdown = document.getElementById(
          "notification-dropdown"
        );

        // Close notification dropdown if open
        notificationDropdown.classList.add("hidden");

        // Toggle profile dropdown
        dropdown.classList.toggle("hidden");
      }

      function logout() {
        // Show logout confirmation
        const confirmMsg = document.createElement("div");
        confirmMsg.className =
          "fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50";
        confirmMsg.innerHTML = `
                <div class="bg-white rounded-lg p-6 max-w-sm mx-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Confirm Logout</h3>
                    <p class="text-gray-600 mb-6">Are you sure you want to logout?</p>
                    <div class="flex space-x-3">
                        <button onclick="this.parentElement.parentElement.parentElement.remove()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancel
                        </button>
                        <button onclick="performLogout()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Logout
                        </button>
                    </div>
                </div>
            `;
        document.body.appendChild(confirmMsg);
      }

      function performLogout() {
        // Remove confirmation dialog
        document.querySelector(".fixed.inset-0").remove();

        // Show logout success message
        const successMsg = document.createElement("div");
        successMsg.className =
          "fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50";
        successMsg.textContent = "Logged out successfully!";
        document.body.appendChild(successMsg);

        setTimeout(() => {
          successMsg.remove();
          // In a real app, this would redirect to login page
        }, 2000);
      }

      // Top-right alert functions
      function showTopRightAlert(type) {
        const alertContainer = document.getElementById("alert-container");

        const alerts = {
          success: {
            title: "Success!",
            message: "Operation completed successfully.",
            bgColor: "bg-green-50",
            borderColor: "border-green-200",
            iconBg: "bg-green-500",
            icon: "fas fa-check",
            textColor: "text-green-800",
            messageColor: "text-green-700",
            closeColor: "text-green-600 hover:text-green-800",
          },
          error: {
            title: "Error!",
            message: "Something went wrong. Please try again.",
            bgColor: "bg-red-50",
            borderColor: "border-red-200",
            iconBg: "bg-red-500",
            icon: "fas fa-times",
            textColor: "text-red-800",
            messageColor: "text-red-700",
            closeColor: "text-red-600 hover:text-red-800",
          },
          warning: {
            title: "Warning!",
            message: "Please review your settings before proceeding.",
            bgColor: "bg-yellow-50",
            borderColor: "border-yellow-200",
            iconBg: "bg-yellow-500",
            icon: "fas fa-exclamation",
            textColor: "text-yellow-800",
            messageColor: "text-yellow-700",
            closeColor: "text-yellow-600 hover:text-yellow-800",
          },
          info: {
            title: "Information",
            message: "Here is some useful information for you.",
            bgColor: "bg-blue-50",
            borderColor: "border-blue-200",
            iconBg: "bg-blue-500",
            icon: "fas fa-info",
            textColor: "text-blue-800",
            messageColor: "text-blue-700",
            closeColor: "text-blue-600 hover:text-blue-800",
          },
        };

        const alertData = alerts[type];
        const alertId = "alert-" + Date.now();

        const alertElement = document.createElement("div");
        alertElement.id = alertId;
        alertElement.className = `alert-item ${alertData.bgColor} ${alertData.borderColor} border rounded-xl p-4 shadow-lg`;

        alertElement.innerHTML = `
                <div class="flex items-start">
                    <div class="w-6 h-6 ${alertData.iconBg} rounded-full flex items-center justify-center text-white mr-3 mt-0.5 flex-shrink-0">
                        <i class="${alertData.icon} text-xs"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-semibold ${alertData.textColor} mb-1">${alertData.title}</h4>
                        <p class="text-sm ${alertData.messageColor}">${alertData.message}</p>
                    </div>
                    <button onclick="removeTopRightAlert('${alertId}')" class="${alertData.closeColor} ml-3 flex-shrink-0">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

        alertContainer.appendChild(alertElement);

        // Auto remove after 5 seconds
        setTimeout(() => {
          removeTopRightAlert(alertId);
        }, 5000);
      }

      function removeTopRightAlert(alertId) {
        const alertElement = document.getElementById(alertId);
        if (alertElement) {
          alertElement.classList.add("alert-exit");
          setTimeout(() => {
            if (alertElement.parentNode) {
              alertElement.remove();
            }
          }, 300);
        }
      }

      // File input handling functions
      function handleFileSelect(input, displayId) {
        const file = input.files[0];
        const display = document.getElementById(displayId);
        const nameElement = document.getElementById(
          displayId.replace("-display", "-name")
        );

        if (file) {
          display.classList.remove("hidden");
          nameElement.textContent = file.name;

          // Show success alert for file upload
          showTopRightAlert("success");
        }
      }

      function clearFileInput(inputId, displayId) {
        const input = document.getElementById(inputId);
        const display = document.getElementById(displayId);

        input.value = "";
        display.classList.add("hidden");
      }

      // Show random alert function
      function showRandomAlert() {
        const alerts = [
          {
            type: "success",
            title: "Success!",
            message: "Operation completed successfully.",
          },
          {
            type: "info",
            title: "Information",
            message: "Here is some useful information for you.",
          },
          {
            type: "warning",
            title: "Warning",
            message: "Please review your settings before proceeding.",
          },
          {
            type: "error",
            title: "Error",
            message: "Something went wrong. Please try again.",
          },
          {
            type: "purple",
            title: "New Feature",
            message: "Check out our latest feature update!",
          },
        ];

        const randomAlert = alerts[Math.floor(Math.random() * alerts.length)];

        const alertElement = document.createElement("div");
        alertElement.className = `fixed top-4 right-4 max-w-sm z-50 alert-animation`;

        const colorClasses = {
          success: "bg-green-50 border-green-200",
          info: "bg-blue-50 border-blue-200",
          warning: "bg-yellow-50 border-yellow-200",
          error: "bg-red-50 border-red-200",
          purple: "bg-purple-50 border-purple-200",
        };

        const iconClasses = {
          success: "fas fa-check bg-green-500",
          info: "fas fa-info bg-blue-500",
          warning: "fas fa-exclamation bg-yellow-500",
          error: "fas fa-times bg-red-500",
          purple: "fas fa-star bg-purple-500",
        };

        const textClasses = {
          success: "text-green-800 text-green-700 text-green-600",
          info: "text-blue-800 text-blue-700 text-blue-600",
          warning: "text-yellow-800 text-yellow-700 text-yellow-600",
          error: "text-red-800 text-red-700 text-red-600",
          purple: "text-purple-800 text-purple-700 text-purple-600",
        };

        alertElement.innerHTML = `
                <div class="${
                  colorClasses[randomAlert.type]
                } border rounded-xl p-4">
                    <div class="flex items-start">
                        <div class="w-6 h-6 ${
                          iconClasses[randomAlert.type].split(" ")[1]
                        } rounded-full flex items-center justify-center text-white mr-3 mt-0.5">
                            <i class="${
                              iconClasses[randomAlert.type].split(" ")[0]
                            } text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold ${
                              textClasses[randomAlert.type].split(" ")[0]
                            } mb-1">${randomAlert.title}</h4>
                            <p class="text-sm ${
                              textClasses[randomAlert.type].split(" ")[1]
                            }">${randomAlert.message}</p>
                        </div>
                        <button onclick="this.closest('.fixed').remove()" class="${
                          textClasses[randomAlert.type].split(" ")[2]
                        } hover:${
          textClasses[randomAlert.type].split(" ")[0]
        } ml-3">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;

        document.body.appendChild(alertElement);

        // Auto remove after 5 seconds
        setTimeout(() => {
          if (alertElement.parentNode) {
            alertElement.remove();
          }
        }, 5000);
      }

      // Close dropdowns when clicking outside
      document.addEventListener("click", function (event) {
        const notificationBtn = document.getElementById("notification-btn");
        const notificationDropdown = document.getElementById(
          "notification-dropdown"
        );
        const profileBtn = document.getElementById("profile-btn");
        const profileDropdown = document.getElementById("profile-dropdown");

        // Close notification dropdown if clicking outside
        if (
          !notificationBtn.contains(event.target) &&
          !notificationDropdown.contains(event.target)
        ) {
          notificationDropdown.classList.add("hidden");
        }

        // Close profile dropdown if clicking outside
        if (
          !profileBtn.contains(event.target) &&
          !profileDropdown.contains(event.target)
        ) {
          profileDropdown.classList.add("hidden");
        }

        // Close custom dropdowns if clicking outside
        const customDropdowns = document.querySelectorAll(".custom-dropdown");
        customDropdowns.forEach((dropdown) => {
          if (!dropdown.contains(event.target)) {
            dropdown.classList.remove("open");
            dropdown
              .querySelector(".custom-dropdown-menu")
              .classList.add("hidden");
          }
        });
      });

      // Initialize the application
      function init() {
        initDarkMode();
        updateTime();
        setInterval(updateTime, 1000);

        // Initialize sidebar state
        const isMobile = window.innerWidth < 1024;
        const mainContent = document.getElementById("main-content");
        const toggleBtn = document.getElementById("sidebar-toggle-btn");
        const toggleIcon = document.getElementById("sidebar-toggle-icon");

        if (sidebarVisible && !isMobile) {
          toggleBtn.style.display = "none";
          toggleIcon.className = "fas fa-times text-lg";
          mainContent.style.marginLeft = "0";
        } else {
          if (!isMobile && !sidebarVisible) {
            toggleBtn.style.display = "block";
            mainContent.style.marginLeft = "0";
            mainContent.style.width = "100%";
          }
          toggleIcon.className = "fas fa-bars text-lg";
        }
      }

      // Initialize the application
      init();
    // </script>
    // <script>
      (function () {
        function c() {
          var b = a.contentDocument || a.contentWindow.document;
          if (b) {
            var d = b.createElement("script");
            d.innerHTML =
              "window.__CF$cv$params={r:'99abff54d319ea7d',t:'MTc2MjUwOTc3MS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
            b.getElementsByTagName("head")[0].appendChild(d);
          }
        }
        if (document.body) {
          var a = document.createElement("iframe");
          a.height = 1;
          a.width = 1;
          a.style.position = "absolute";
          a.style.top = 0;
          a.style.left = 0;
          a.style.border = "none";
          a.style.visibility = "hidden";
          document.body.appendChild(a);
          if ("loading" !== document.readyState) c();
          else if (window.addEventListener)
            document.addEventListener("DOMContentLoaded", c);
          else {
            var e = document.onreadystatechange || function () {};
            document.onreadystatechange = function (b) {
              e(b);
              "loading" !== document.readyState &&
                ((document.onreadystatechange = e), c());
            };
          }
        }
      })();
