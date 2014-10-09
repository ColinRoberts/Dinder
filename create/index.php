<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Dinder v0.1</title>
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:100,300,400,600,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Comfortaa:400,300,700' rel='stylesheet' type='text/css'>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<link href="../src/select2.css" rel="stylesheet"/>
		<script src="../src/select2.js"></script>
		<script type="text/javascript">
			var step1, step2, step3, step4;
			var step;
			var query = {};
			$(document).ready(function() {
				step1 = $("#step1");
				step2 = $("#step2");
				step3 = $("#step3");
				step4 = $("#step4");
				
				step1.find(".create_node_number").hide()
				step1.find(".create_node_content").show()
				step2.find(".create_node_title").hide();
				step3.find(".create_node_title").hide();
				step4.find(".create_node_title").hide();
				
				opacity(step2, .8);
				opacity(step3, .6);
				opacity(step4, .4);
				
				$("#step1_select").select2();
				$("#step2_select").select2();
				$("#step3_select").select2();
				$("#step4_select").select2();
			});
			function opacity(elem, val) {
				elem.find('.create_node_number').css({opacity: val});
			}
			function complete(elem) {
				elem.find('.create_node_number').css({background: "green"});
				elem.find(".create_node_number").show()
				elem.find(".create_node_content").hide()
				elem.find(".create_node_title").hide()
			}
			function changeStep(num) {
				$("#step_bar").attr("src", "../images/step"+num+".png");
				if (num == 2) {
					complete(step1);
					step2.find(".create_node_number").hide()
					step2.find(".create_node_content").show()
					step2.find(".create_node_title").show()
					opacity(step3, .8);
					opacity(step4, .6)
					query.type = $("#step1_select").val();
				} else if (num == 3) {
					complete(step2);
					step3.find(".create_node_number").hide()
					step3.find(".create_node_content").show()
					step3.find(".create_node_title").show()
					opacity(step4, .8)
					query.size = $("#step2_select").val();
				} else if (num == 4) {
					complete(step3);
					step4.find(".create_node_number").hide()
					step4.find(".create_node_content").show()
					step4.find(".create_node_title").show()
					query.time = $("#step3_select").val();
				}
			}
			function submit() {
				query.intent = $("#step4_select").val();
				$.ajax({
					url: "submit.php?json="+query,
					success: function(resp) {
						//provide current dinners if matched, otherwise generic waiting-for-match response
					}
				});
			}
		</script>
	</head>
	<body>
		<div id="header">
			<div id="header_main">
				<a href="#" id="logo"><img src="../images/logo.png" /></a>
				<div id="nav_options">
					<a href="#" class="nav_option">Find a Dinner</a>
					<a href="#" class="nav_option">See Past Dinners</a>
				</div>
			</div>
		</div>
		<div id="content">
			<div id="sb_cont">
				<img id="step_bar" src="../images/step1.png" />
			</div>
			<div class="create_node" id="step1">
				<div class="create_node_title">
					Step One <span>What are you in the mood for?</span>
				</div>
				<div class="create_node_break"></div>
				<div class="create_node_content">
					<select id="step1_select">
						<option>American</option>
						<option>Japanese</option>
						<option>Chinese</option>
						<option>Indian</option>
					</select>
					<div class="next_button" onClick="changeStep(2);"></div>
				</div>
				<div class="create_node_number">
					1
				</div>
			</div>
			<div class="create_node" id="step2">
				<div class="create_node_title">
					Step Two <span>How big of a group?</span>
				</div>
				<div class="create_node_break"></div>
				<div class="create_node_content">
					<select id="step2_select">
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5 or more</option>
					</select>
					<div class="next_button" onClick="changeStep(3);"></div>
				</div>
				<div class="create_node_number">
					2
				</div>
			</div>
			<div class="create_node" id="step3">
				<div class="create_node_title">
					Step Three <span>What time do you want dinner?</span>
				</div>
				<div class="create_node_break"></div>
				<div class="create_node_content">
					<select id="step3_select">
						<option>5:00 pm</option>
						<option>5:30 pm</option>
						<option>6:00 pm</option>
						<option>6:30 pm</option>
						<option>7:00 pm</option>
						<option>7:30 pm</option>
						<option>8:00 pm</option>
						<option>8:30 pm</option>
						<option>9:00 pm</option>
						<option>9:30 pm</option>
						<option>10:00 pm</option>
						<option>10:30 pm</option>
						<option>11:00 pm</option>
						<option>11:30 pm</option>
						<option>12:00 am</option>
					</select>
					<div class="next_button" onClick="changeStep(4);"></div>
				</div>
				<div class="create_node_number">
					3
				</div>
			</div>
			<div class="create_node" id="step4">
				<div class="create_node_title">
					Step Four <span>Select your dinner intent</span>
				</div>
				<div class="create_node_break"></div>
				<div class="create_node_content">
					<select id="step4_select">
						<option>Platonic</option>
						<option>Party</option>
						<option>Romantic</option>
					</select>
					<div class="complete_button" onClick="submit();"></div>
				</div>
				<div class="create_node_number">
					4
				</div>
			</div>
		</div>
	</body>
</html>