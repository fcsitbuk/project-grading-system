<header>
		
	<div class="in_header">
		
		<div class="logo">
			
			<h2><span onclick="toggle_class()" class="menu_icon"></span><span class="header_icon"></span>FCSIT Project Manager</h2>
			
		</div>
		
		<div class="search_bar">
			
			<form>
				
				<input type="text" id="faculty" class="blue" name="faculty" value=""  size="1" />
				
				<select id="year" name="year" >
					
					<option value="16">16</option>
					<option value="15">15</option>
					<option value="14">14</option>
					<option value="13">13</option>
					<option selected="true" value="12">12</option>
					<option value="11">11</option>
					<option value="10">10</option>
					<option value="09">09</option>
					
				</select>
				
				<select id="dept" name="department" >
					
					<option value="COM">COM</option>
					<option value="SWE">SWE</option>
					<option value="ICT">ICT</option>
					
				</select>
				
				<input type="search" name="search" placeholder="Enter search key" id="serial" onkeyup="fetch_data()" autofocus maxlength="5" />
				
			</form>
			
		</div>
		
		<p class="clear"></p>
		
	</div>
	
</header>