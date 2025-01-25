<div class="progress-tracker-container">
    <ul class="progress-steps">
        @foreach ($steps as $index => $step)
            <li class="progress-step @if ($index + 1 <= $current) active @endif">
                <div class="step-number">{{ $index + 1 }}</div>
                <div class="step-label">{{ $step }}</div>
                <div class="step-line @if ($index + 1 < $current) filled @endif"></div>
            </li>
        @endforeach
    </ul>
</div>



<style>
/* Container Styling */
.progress-tracker-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 30px 0;
    font-family: Arial, sans-serif;
}

/* Progress Steps List */
.progress-steps {
    display: flex;
    padding: 0;
    margin: 0;
    list-style: none;
    width: 100%;
    max-width: 900px;
    position: relative;
}

/* Progress Step Item */
.progress-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    flex: 1;
    text-align: center;
    padding: 0 10px;
}

/* Step Number */
.step-number {
    background: #d1d5db; /* Light gray */
    color: #fff;
    font-size: 18px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 2;
    position: relative;
    transition: background 0.3s ease;
}

/* Active or Completed Step Number */
.progress-step.active .step-number,
.progress-step.completed .step-number {
    background: #4caf50; /* Green */
}

/* Step Label */
.step-label {
    margin-top: 8px;
    font-size: 14px;
    color: #6b7280; /* Gray text */
    font-weight: 500;
    max-width: 120px;
    word-wrap: break-word;
    text-align: center;
}

/* Step Line */
.step-line {
    position: absolute;
    top: 18px; /* Adjusted to avoid overlap with text */
    height: 4px;
    width: 100%;
    background: #d1d5db; /* Light gray */
    z-index: 1;
    left: 50%;
    transform: translateX(-50%);
}

.step-line.filled {
    background: #4caf50; /* Green for completed steps */
}

/* Hide lines for first and last steps */
.progress-step:first-child .step-line {
    display: none;
}

.progress-step:last-child .step-line {
    display: none;
}

/* Hover Effect */
.progress-step:hover .step-number {
    cursor: pointer;
    transform: translateY(-5px);
}

/* For Mobile View - Adjust the layout */
@media (max-width: 768px) {
    .progress-steps {
        flex-direction: column;
        max-width: 100%;
    }

    .progress-step {
        flex-direction: row;
        margin-bottom: 15px;
    }

    .step-number {
        width: 35px;
        height: 35px;
        font-size: 16px;
    }

    .step-label {
        font-size: 12px;
    }

    .step-line {
        position: absolute;
        top: 22px;
        width: 50%;
        left: 50%;
        transform: translateX(-50%);
    }
}

</style>
