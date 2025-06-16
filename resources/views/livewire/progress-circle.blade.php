<div>
    <div class="progress-container flex flex-col justify-center items-center">
        <svg class="progress-circle" width="200" height="200" viewBox="0 0 100 100">
            <defs>
                <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#FFFFFF;stop-opacity:1" />
                    <stop offset="25%" style="stop-color:#C0F8BF;stop-opacity:1" />
                    <stop offset="50%" style="stop-color:#F6F8F7;stop-opacity:1" />
                    <stop offset="75%" style="stop-color:#FEE55A;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#A5D376;stop-opacity:1" />
                </linearGradient>
            </defs>
            <circle class="circle-outer" cx="50" cy="50" r="46" stroke="#e6e6e6" stroke-width="2" fill="none" />
            <circle class="circle-background" cx="50" cy="50" r="45" stroke="url(#gradient)" stroke-width="5" fill="none" />
            <circle class="circle-progress"
                    cx="50" cy="50" r="45"
                    stroke="url(#gradient)" stroke-width="5" fill="none"
                    stroke-dasharray="282.74"
                    stroke-dashoffset="{{ $progressOffset }}" />
        </svg>

        <div class="progress-text text-sc-almost-black p-4 font-semibold text-[14px] flex flex-col">
            <div class="mb-1 bg-sc-border text-center items-center justify-center rounded-2xl flex mx-[-19px]">
                <span class="p-1 text-center">{{ $nextLevel - $currentLevel }} анкет</span>
            </div>
            <div class="text-center text-[12px] text-sc-almost-black"> осталось </div>
        </div>
    </div>
</div>
