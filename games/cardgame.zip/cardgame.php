
	<script src="game.js"></script>
	<script src="spritoon.js"></script>
	<script>
		document.addEventListener("DOMContentLoaded", function(event){
			const game = new Game();
			window.game = game;
			window.addEventListener('resize', function(){ game.resize(); });
		});
	</script>
	<canvas id="game" style="border:1px solid #000000; background:url(felt.jpg);"></canvas>

