<?php
header('Access-Control-Allow-Origin: *');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("./src/config/connection_db.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Production Startup Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --primary-active: #1e40af;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --background-color: #f8fafc;
            --card-background: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --radius-md: 8px;
            --radius-lg: 12px;
            --radius-xl: 16px;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="%23ffffff" opacity="0.1"/><circle cx="10" cy="50" r="0.5" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            width: 100%;
            max-width: 480px;
        }

        .form-container {
            background: var(--card-background);
            padding: 32px;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            width: 100%;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), #8b5cf6, #ec4899);
        }

        .form-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .form-title {
            color: var(--text-primary);
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .form-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-primary);
            font-size: 14px;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 16px;
            transition: all 0.2s ease;
            background: var(--card-background);
            color: var(--text-primary);
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-input:hover,
        .form-select:hover {
            border-color: var(--secondary-color);
        }

        .submit-btn {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            border: none;
            border-radius: var(--radius-md);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .keyboard-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .keyboard-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 15px 25px -5px rgba(37, 99, 235, 0.4);
        }

        .keyboard-container {
            position: fixed;
            bottom: -300px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-xl);
            padding: 20px;
            box-shadow: var(--shadow-lg);
            transition: bottom 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 999;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .keyboard-container.visible {
            bottom: 30px;
        }

        .keyboard-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }

        .keyboard-key {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-md);
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            user-select: none;
        }

        .keyboard-key:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .keyboard-key:active {
            transform: scale(0.95);
            background: rgba(255, 255, 255, 0.3);
        }

        .keyboard-actions {
            display: flex;
            gap: 10px;
        }

        .keyboard-action {
            flex: 1;
            height: 45px;
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: var(--radius-md);
            color: #fca5a5;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .keyboard-action:hover {
            background: rgba(239, 68, 68, 0.3);
        }

        .keyboard-action.clear {
            background: rgba(16, 185, 129, 0.2);
            border-color: rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
        }

        .keyboard-action.clear:hover {
            background: rgba(16, 185, 129, 0.3);
        }

        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .success-message,
        .error-message {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 20px;
            border-radius: var(--radius-md);
            color: white;
            font-weight: 500;
            box-shadow: var(--shadow-lg);
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 1001;
        }

        .success-message {
            background: var(--success-color);
        }

        .error-message {
            background: var(--danger-color);
        }

        .success-message.show,
        .error-message.show {
            transform: translateX(0);
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .main-container {
                max-width: 100%;
            }
            
            .form-container {
                padding: 24px;
                margin: 0 10px;
            }
            
            .keyboard-container {
                left: 10px;
                right: 10px;
                transform: none;
            }
            
            .keyboard-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="form-container">
            <div class="form-header">
                <h1 class="form-title">
                    <i class="fas fa-cogs"></i>
                    Production Startup
                </h1>
                <p class="form-subtitle">Enter production details to begin</p>
            </div>

            <form id="startupForm">
                <div class="form-group">
                    <label class="form-label" for="timeStart">
                        <i class="fas fa-clock"></i> Time Start
                    </label>
                    <select class="form-select" id="timeStart" name="time_start" required>
                        <option value="">Select Start Time</option>
                        <option value="1">6:00 AM</option>
                        <option value="2">7:00 AM</option>
                        <option value="3">8:00 AM</option>
                        <option value="4">9:00 AM</option>
                        <option value="5">10:00 AM</option>
                        <option value="6">11:00 AM</option>
                        <option value="7">12:00 PM</option>
                        <option value="8">1:00 PM</option>
                        <option value="9">2:00 PM</option>
                        <option value="10">3:00 PM</option>
                        <option value="11">4:00 PM</option>
                        <option value="12">5:00 PM</option>
                        <option value="13">6:00 PM</option>
                        <option value="14">7:00 PM</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="partNo">
                        <i class="fas fa-barcode"></i> Part Number
                    </label>
                    <select class="form-select" id="partNo" name="part_no" required>
                        <option value="">Select Part Number</option>
                        <?php
                    $sql = "SELECT id ,part_no,line, model, date_created FROM details_product";
                    $resultset = mysqli_query($conn, $sql);
                    while ($rows = mysqli_fetch_assoc($resultset)) {
                    ?>
                        <option value="<?php echo $rows["id"]; ?>"><?php echo $rows["part_no"]; ?></option>
                    <?php }    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="remainingBalance">
                        <i class="fas fa-calculator"></i> Remaining Balance
                    </label>
                    <div class="input-icon">
                        <input 
                            type="number" 
                            class="form-input" 
                            id="remainingBalance" 
                            name="remainingBalance"
                            placeholder="Enter remaining balance"
                            min="0"
                            step="1"
                            required
                        >
                        <i class="fas fa-hashtag"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="pic">
                        <i class="fas fa-user"></i> Person in Charge (PIC)
                    </label>
                    <select class="form-select" id="pic" name="pic" required>
                        <option value="">Select PIC</option>
                        <option value="Rolando">Rolando</option>
                        <option value="Shan">Shan</option>
                        <option value="Vince">Vince</option>
                        <option value="Gulatera">Gulatera</option>
                        <option value="Repalda">Repalda</option>
                        <option value="Go">Go</option>
                        <option value="Parinas">Parinas</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    <span class="submit-text">Start Production</span>
                    <div class="loading-spinner"></div>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Virtual Keyboard -->
    <button class="keyboard-toggle" id="keyboardToggle">
        <i class="fas fa-keyboard"></i>
    </button>

    <div class="keyboard-container" id="keyboardContainer">
        <div class="keyboard-grid">
            <div class="keyboard-key" data-key="1">1</div>
            <div class="keyboard-key" data-key="2">2</div>
            <div class="keyboard-key" data-key="3">3</div>
            <div class="keyboard-key" data-key="4">4</div>
            <div class="keyboard-key" data-key="5">5</div>
            <div class="keyboard-key" data-key="6">6</div>
            <div class="keyboard-key" data-key="7">7</div>
            <div class="keyboard-key" data-key="8">8</div>
            <div class="keyboard-key" data-key="9">9</div>
            <div class="keyboard-key" data-key="0">0</div>
        </div>
        <div class="keyboard-actions">
            <button class="keyboard-action" id="backspaceBtn">
                <i class="fas fa-backspace"></i>
                Delete
            </button>
            <button class="keyboard-action clear" id="clearBtn">
                <i class="fas fa-times"></i>
                Clear
            </button>
        </div>
    </div>

    <!-- Toast Messages -->
    <div class="success-message" id="successMessage">
        <i class="fas fa-check-circle"></i>
        Data submitted successfully!
    </div>
    <div class="error-message" id="errorMessage">
        <i class="fas fa-exclamation-circle"></i>
        <span id="errorText">An error occurred!</span>
    </div>

    <script>
        class ProductionStartupForm {
            constructor() {
                this.activeInput = null;
                this.isSubmitting = false;
                this.init();
            }

            init() {
                this.bindEvents();
                this.setupValidation();
            }

            bindEvents() {
                // Form submission
                document.getElementById('startupForm').addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.handleSubmit();
                });

                // Keyboard toggle
                document.getElementById('keyboardToggle').addEventListener('click', () => {
                    this.toggleKeyboard();
                });

                // Virtual keyboard events
                document.querySelectorAll('.keyboard-key').forEach(key => {
                    key.addEventListener('click', () => {
                        this.addToInput(key.dataset.key);
                    });
                });

                document.getElementById('backspaceBtn').addEventListener('click', () => {
                    this.deleteFromInput();
                });

                document.getElementById('clearBtn').addEventListener('click', () => {
                    this.clearInput();
                });

                // Input focus tracking
                document.getElementById('remainingBalance').addEventListener('focus', () => {
                    this.activeInput = document.getElementById('remainingBalance');
                });
                document.getElementById('btnGuide').addEventListener('click', () => {
                    this.displayGuideBtn();
                });
                // Click outside to close keyboard
                document.addEventListener('click', (e) => {
                    if (!e.target.closest('.keyboard-container') && 
                        !e.target.closest('.keyboard-toggle') && 
                        !e.target.closest('#remainingBalance')) {
                        this.hideKeyboard();
                    }
                });
            }

            setupValidation() {
                const inputs = document.querySelectorAll('.form-input, .form-select');
                inputs.forEach(input => {
                    input.addEventListener('blur', () => this.validateField(input));
                    input.addEventListener('input', () => this.clearFieldError(input));
                });
            }

            validateField(field) {
                if (field.hasAttribute('required') && !field.value.trim()) {
                    this.showFieldError(field, 'This field is required');
                    return false;
                }

                if (field.type === 'number' && field.value < 0) {
                    this.showFieldError(field, 'Value must be positive');
                    return false;
                }

                this.clearFieldError(field);
                return true;
            }

            showFieldError(field, message) {
                field.style.borderColor = 'var(--danger-color)';
                field.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
            }

            clearFieldError(field) {
                field.style.borderColor = '';
                field.style.boxShadow = '';
            }
            displayGuideBtn(){
                

            }
            async handleSubmit() {
                if (this.isSubmitting) return;

                const formData = this.getFormData();
                
                if (!this.validateForm(formData)) {
                    this.showError('Please fill in all required fields correctly');
                    return;
                }

                this.setSubmitting(true);

                try {
                    await this.submitData(formData);
                    this.showSuccess('Production startup data submitted successfully!');
                    this.resetForm();
                    
                    // Simulate redirect
                    setTimeout(() => {
                        console.log('Redirecting to lcd_rev_code1.php');
                         window.location.href = "../public/lcd_rev_code1.php";
                    }, 1000);
                    
                } catch (error) {
                    this.showError(error.message || 'Failed to submit data');
                } finally {
                    this.setSubmitting(false);
                }
            }

            getFormData() {
                return {
                    timeStart: document.getElementById('timeStart').value,
                    partNo: document.getElementById('partNo').value,
                    remainingBalance: document.getElementById('remainingBalance').value,
                    pic: document.getElementById('pic').value
                };
            }

            validateForm(data) {
                return Object.values(data).every(value => value.trim() !== '');
            }

            async submitData(data) {
                // Simulate API calls
                const inputData1 = {
                    partno: data.partNo,
                    balance: data.remainingBalance
                };

                const inputData2 = {
                    time_id: data.timeStart,
                    pic_startup: data.pic
                };

                // Simulate async operations
                await this.sendRequest('server_inputdata1.php', inputData1);
                await this.sendRequest('server_inputdata2.php', inputData2);
            }

            async sendRequest(url, data) {
                return new Promise((resolve, reject) => {
                    const xhr = new XMLHttpRequest();
                    const urlEncodedData = Object.keys(data)
                        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(data[key]))
                        .join('&');

                    xhr.open('POST', url, true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                resolve(xhr.responseText);
                            } else {
                                reject(new Error(`HTTP ${xhr.status}: ${xhr.statusText}`));
                            }
                        }
                    };

                    xhr.onerror = () => reject(new Error('Network error'));
                    xhr.send(urlEncodedData);
                });
            }

            setSubmitting(isSubmitting) {
                this.isSubmitting = isSubmitting;
                const submitBtn = document.getElementById('submitBtn');
                const submitText = submitBtn.querySelector('.submit-text');
                const loadingSpinner = submitBtn.querySelector('.loading-spinner');
                const arrow = submitBtn.querySelector('.fa-arrow-right');

                if (isSubmitting) {
                    submitBtn.disabled = true;
                    submitText.textContent = 'Submitting...';
                    loadingSpinner.style.display = 'block';
                    arrow.style.display = 'none';
                } else {
                    submitBtn.disabled = false;
                    submitText.textContent = 'Start Production';
                    loadingSpinner.style.display = 'none';
                    arrow.style.display = 'block';
                }
            }

            resetForm() {
                document.getElementById('startupForm').reset();
                this.hideKeyboard();
            }

            toggleKeyboard() {
                const container = document.getElementById('keyboardContainer');
                container.classList.toggle('visible');
            }

            hideKeyboard() {
                const container = document.getElementById('keyboardContainer');
                container.classList.remove('visible');
            }

            addToInput(value) {
                if (this.activeInput) {
                    this.activeInput.value += value;
                    this.activeInput.dispatchEvent(new Event('input'));
                }
            }

            deleteFromInput() {
                if (this.activeInput && this.activeInput.value.length > 0) {
                    this.activeInput.value = this.activeInput.value.slice(0, -1);
                    this.activeInput.dispatchEvent(new Event('input'));
                }
            }

            clearInput() {
                if (this.activeInput) {
                    this.activeInput.value = '';
                    this.activeInput.dispatchEvent(new Event('input'));
                }
            }

            showSuccess(message) {
                const successEl = document.getElementById('successMessage');
                successEl.textContent = message;
                successEl.classList.add('show');
                setTimeout(() => successEl.classList.remove('show'), 5000);
            }

            showError(message) {
                const errorEl = document.getElementById('errorMessage');
                const errorText = document.getElementById('errorText');
                errorText.textContent = message;
                errorEl.classList.add('show');
                setTimeout(() => errorEl.classList.remove('show'), 5000);
            }
        }

        // Initialize the application
        document.addEventListener('DOMContentLoaded', () => {
            new ProductionStartupForm();
        });
    </script>
</body>
</html>