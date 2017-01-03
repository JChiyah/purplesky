<h1>Nav bar placeholder</h1>

<!-- Simple grid example
Check https://v4-alpha.getbootstrap.com/layout/grid/
for more information on the grid system and layout

Check http://getbootstrap.com/css/#responsive-utilities
for responsive tools and classes, such as .hidden-xs

SIZE CHART GUIDE
    md - medium   | some tablets and small desktops
    lg - large    | desktops
-->

<div class="container">
	<div class="row">
		<!-- A row with 2 columns -->
		<div style="background: white" class="col-lg-5">
			<h1>Employee</h1>
			<hr>
			<!--double check should these be labels or text fields? or do they turn into text fields after edit-->
			<p>Employee email</P>
			<p>account role</p>
			<p>Location</p>
			<hr>
			<br>
			<from action="link_blank"><!--Maybe use a ref link to next page?-->
				<input type="submit" value="ChangePassword" />
			</from>
		</div>
		<br>
		<!--Skill section-->
		<div style="background: white" class="col-lg-5">
			<h1>Skils</h1>
			<hr>
			<div class="form-group">
				<label for="Skill">Skill:</label>
				<input type="text" class="form-control" id="Skill">
			</div>
			<br>
			<label for="skillArea">Skill Selection:</label><br>
			<textarea class="form-control" rows="5" id="skillArea"></textarea>
		</div>
	</div>

	<!--Exp section-->
	<h1>Experience</h1>
	<hr>
	<div class="row">
		<div style="background: white" class="col-xs-12 col-md-8">Title:
			<form>
				<input type="text" name="Title" value="">
			</form>
		</div>
		<div style="background: white" class="col-xs-12 col-md-4">From
			<form>
				<input type="text" name="From" value="DD/MM/YYYY">
			</form>
		</div>
	</div>
	<div class="row">
		<div style="background: white" class="col-xs-12 col-md-8"></div>
		<div style="background: white" class="col-xs-12 col-md-4">To:
			<form>
				<input type="text" name="From" value="DD/MM/YYYY">
			</form>
		</div>
	</div>
	<div class="row">
		<div style="background: white" class="col-xs-12 col-md-12">Description:
			<form>
				<textarea name="Description" rows="5" cols="100"></textarea>
			</form>
		</div>
	</div>
</div>
