<div class="progress-container">
  <div class="scroll-circle">
  
    <svg viewBox="0 0 100 100" class="progress-circle">
      <defs>
        <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stop-color="#FFC300"></stop>
          <stop offset="100%" stop-color="#FFC300"></stop>
        </linearGradient>
      </defs>
      <circle cx="42" cy="59" r="40" class="progress-bg"></circle>
      <circle cx="42" cy="59" r="40" class="progress-bar" id="progress-bar" style="stroke-dasharray: 282.743, 282.743; stroke-dashoffset: 0;"></circle>
    </svg>

    <svg viewBox="0 0 200 200" class="rotating-text">
      <defs>
        <path id="circlePath" d="M100,100 m-75,0 a75,75 0 1,1 150,0 a75,75 0 1,1 -150,0"></path>
      </defs>
      <text>
        <textPath xlink:href="#circlePath" startOffset="0%" fill="#FFC300" font-size="16" font-weight="bold">
          Scroll to explore • Scroll to explore • Scroll to explore •
        </textPath>
      </text>
    </svg>

  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const progressBar = document.getElementById('progress-bar');
  //  const progressText = document.getElementById('progress-text');
    
    // Calculate the circumference of the circle
    const radius = progressBar.getAttribute('r');
    const circumference = 2 * Math.PI * radius;
    
    // Set the initial stroke-dasharray and stroke-dashoffset
    progressBar.style.strokeDasharray = `${circumference} ${circumference}`;
    progressBar.style.strokeDashoffset = circumference;
    
    // Update progress function
    function updateProgress() {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
      const scrollPercentage = scrollTop / scrollHeight;
      
      // Calculate the offset based on scroll percentage
      const offset = circumference - (scrollPercentage * circumference);
      
      // Update the progress bar
      progressBar.style.strokeDashoffset = offset;
      
      // Update the text
      //progressText.textContent = `${Math.round(scrollPercentage * 100)}%`;
    }
    
    // Listen for scroll events
    window.addEventListener('scroll', updateProgress);
    
    // Initial update
    updateProgress();
  });
</script>
