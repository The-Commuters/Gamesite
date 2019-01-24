

    <link rel='stylesheet' href='style.css'>
	<script src="game.js"></script>
	<script src="spritoon.js"></script> 
	<script>
		document.addEventListener("DOMContentLoaded", function(event) { 
  			let game = new Game();
		});
	</script>



    <div class="container">
	   <canvas id="game" width="640" height="480" style="border:1px solid #000000;"></canvas>
       <div id="progress">
		  <div class="meter orange">
			<span id="progress-bar" style="width: 0%"></span>
		  </div>
	   </div>
    </div>
