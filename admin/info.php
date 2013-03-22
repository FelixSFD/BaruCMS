<h1><? echo $lang_systemInfo; ?></h1>
<?
if($ECM["rights"]["VIEW_SYSTEM_INFO"]){
?>
<div id="accordion">
	<h3><a href="#"><? echo $lang_serverInfo; ?></a></h3>
	<div>
		<table>
			<tr>
				<td>
					<b><? echo $lang_hostInfo; ?>:</b>
				</td>
				<td>
					<? echo $_SERVER["SERVER_NAME"]; ?>
				</td>
			</tr>
			<tr>
				<td>
					<b><? echo $lang_serverAdmin; ?>:</b>
				</td>
				<td>
					<? echo $_SERVER["SERVER_ADMIN"]; ?>
				</td>
			</tr>
			<tr>
				<td>
					<b><? echo $lang_PHPversion; ?>:</b>
				</td>
				<td>
					<? echo phpversion(); ?>
				</td>
			</tr>
			<tr>
				<td>
					<b><? echo $lang_PHPextensions; ?>:</b>
				</td>
				<td>
					<?
					$install_info = "<table>";
					//file_get_contents()
					$check_FGT = file_get_contents("http://google.de");
					if($check_FGT){
						$install_info .= '<tr><td>file_get_contents()</td><td><img class="true" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0N0I3RTRCODJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0N0I3RTRCOTJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3QjdFNEI2MkNFMjExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQ3QjdFNEI3MkNFMjExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+y7qlaQAAATFJREFUeNpsUTFLw2AQfZcGRKQBBYOgYgtFBzd1EEFBcWlGQRD6F5ycdLQgDq4uCo4VdyF1i4tD8Q+IghEXC920DiGYz3dJqEE9eN+F717uvvdOjDHQOL91HX6tC9BgrjO3ed0iAuJdOXIWjGuuEqeEh7/hE7tEaPFw/iWy9eToGjbnL7y87lg6moWUaArc8tA0VmdPYIn2g6c8K32jGTRLwy6NYKV2BJES7p4Ospqgob+pGCzM7GGpup8W5iZ2MDW2gc7zIT6jbtbBoG4jU70df/WxXGnCGa7ALS8i7F3jpXdTVNG2cnvw8HaJx+4Vau4WEhPhPjxmjovklp376MdJ3+uETU5LoFM+otcBi5J8PjX48Vly+8wvl4U+G/osCKW4QaiNdEdFo7hB4QZJ+xZgAEUmYSGUrvpqAAAAAElFTkSuQmCC" /><br>';
					} else {
						$install_info .= '<tr><td>file_get_contents()</td><td><img class="false" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0N0I3RTRCNDJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0N0I3RTRCNTJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3QjdFNEIyMkNFMjExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQ3QjdFNEIzMkNFMjExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+hNZdKwAAAW1JREFUeNqUUUtLQlEQ/s5NzFePayoZUgiGGyNoYw8ryhZ5occ2+gv+iaJN1NIogqIgNy5SKTSIjEgI+gFGi5JWBZqCthCRbjOngrYNDHNm5vvON2eO0HUdbGmnvZPCDPkqeYSqWQHE6Xy9VKrUGCMYnHLavdSICYNB01stfNMBxWiE3mxmKI8ulypFhW9kYN/CojZ9eYV2h1MCLR4PZm/y6J2PaNxnnPIjrbnCc+gKDGH8NIluiqH0GWw+H3qCo8zVJI5GSKQcqs5ePD7S/9rT4YGsE4ZjQiQdap1YNpKCye1G+O4eBqsVzWoVubEgGu9lcI/m/lCEEFnWMdOMk+cZCaw9FGBUVUzQKCaXS76BCFmF1OLMHNnZhaV/AM/7e8hNhfASP0GH34/A+sbvduJtKxbzK4QYLudvB1v1Ogrra1L27YIEaa2PW5v4bDQyVNqWe6a1eCmJEUnjXEhdIcFkDIzSxxTFf37wS4ABAHX0lvSAx6CMAAAAAElFTkSuQmCC" /><br>';
						$doNotInstall = true;
					}
					
					//copy()
					if(function_exists("copy")){
						$install_info .= '<tr><td>copy()</td><td><img class="true" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0N0I3RTRCODJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0N0I3RTRCOTJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3QjdFNEI2MkNFMjExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQ3QjdFNEI3MkNFMjExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+y7qlaQAAATFJREFUeNpsUTFLw2AQfZcGRKQBBYOgYgtFBzd1EEFBcWlGQRD6F5ycdLQgDq4uCo4VdyF1i4tD8Q+IghEXC920DiGYz3dJqEE9eN+F717uvvdOjDHQOL91HX6tC9BgrjO3ed0iAuJdOXIWjGuuEqeEh7/hE7tEaPFw/iWy9eToGjbnL7y87lg6moWUaArc8tA0VmdPYIn2g6c8K32jGTRLwy6NYKV2BJES7p4Ospqgob+pGCzM7GGpup8W5iZ2MDW2gc7zIT6jbtbBoG4jU70df/WxXGnCGa7ALS8i7F3jpXdTVNG2cnvw8HaJx+4Vau4WEhPhPjxmjovklp376MdJ3+uETU5LoFM+otcBi5J8PjX48Vly+8wvl4U+G/osCKW4QaiNdEdFo7hB4QZJ+xZgAEUmYSGUrvpqAAAAAElFTkSuQmCC" /><br>';
					} else {
						$install_info .= '<tr><td>copy()</td><td><img class="false" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0N0I3RTRCNDJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0N0I3RTRCNTJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3QjdFNEIyMkNFMjExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQ3QjdFNEIzMkNFMjExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+hNZdKwAAAW1JREFUeNqUUUtLQlEQ/s5NzFePayoZUgiGGyNoYw8ryhZ5occ2+gv+iaJN1NIogqIgNy5SKTSIjEgI+gFGi5JWBZqCthCRbjOngrYNDHNm5vvON2eO0HUdbGmnvZPCDPkqeYSqWQHE6Xy9VKrUGCMYnHLavdSICYNB01stfNMBxWiE3mxmKI8ulypFhW9kYN/CojZ9eYV2h1MCLR4PZm/y6J2PaNxnnPIjrbnCc+gKDGH8NIluiqH0GWw+H3qCo8zVJI5GSKQcqs5ePD7S/9rT4YGsE4ZjQiQdap1YNpKCye1G+O4eBqsVzWoVubEgGu9lcI/m/lCEEFnWMdOMk+cZCaw9FGBUVUzQKCaXS76BCFmF1OLMHNnZhaV/AM/7e8hNhfASP0GH34/A+sbvduJtKxbzK4QYLudvB1v1Ogrra1L27YIEaa2PW5v4bDQyVNqWe6a1eCmJEUnjXEhdIcFkDIzSxxTFf37wS4ABAHX0lvSAx6CMAAAAAElFTkSuQmCC" /><br>';
						$doNotInstall = true;
					}
					
					//cURL
					if(function_exists("curl_init")){
						$install_info .= '<tr><td>cURL</td><td><img class="true" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0N0I3RTRCODJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0N0I3RTRCOTJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3QjdFNEI2MkNFMjExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQ3QjdFNEI3MkNFMjExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+y7qlaQAAATFJREFUeNpsUTFLw2AQfZcGRKQBBYOgYgtFBzd1EEFBcWlGQRD6F5ycdLQgDq4uCo4VdyF1i4tD8Q+IghEXC920DiGYz3dJqEE9eN+F717uvvdOjDHQOL91HX6tC9BgrjO3ed0iAuJdOXIWjGuuEqeEh7/hE7tEaPFw/iWy9eToGjbnL7y87lg6moWUaArc8tA0VmdPYIn2g6c8K32jGTRLwy6NYKV2BJES7p4Ospqgob+pGCzM7GGpup8W5iZ2MDW2gc7zIT6jbtbBoG4jU70df/WxXGnCGa7ALS8i7F3jpXdTVNG2cnvw8HaJx+4Vau4WEhPhPjxmjovklp376MdJ3+uETU5LoFM+otcBi5J8PjX48Vly+8wvl4U+G/osCKW4QaiNdEdFo7hB4QZJ+xZgAEUmYSGUrvpqAAAAAElFTkSuQmCC" /><br>';
					} else {
						$install_info .= '<tr><td>cURL</td><td><img class="false" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0N0I3RTRCNDJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0N0I3RTRCNTJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3QjdFNEIyMkNFMjExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQ3QjdFNEIzMkNFMjExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+hNZdKwAAAW1JREFUeNqUUUtLQlEQ/s5NzFePayoZUgiGGyNoYw8ryhZ5occ2+gv+iaJN1NIogqIgNy5SKTSIjEgI+gFGi5JWBZqCthCRbjOngrYNDHNm5vvON2eO0HUdbGmnvZPCDPkqeYSqWQHE6Xy9VKrUGCMYnHLavdSICYNB01stfNMBxWiE3mxmKI8ulypFhW9kYN/CojZ9eYV2h1MCLR4PZm/y6J2PaNxnnPIjrbnCc+gKDGH8NIluiqH0GWw+H3qCo8zVJI5GSKQcqs5ePD7S/9rT4YGsE4ZjQiQdap1YNpKCye1G+O4eBqsVzWoVubEgGu9lcI/m/lCEEFnWMdOMk+cZCaw9FGBUVUzQKCaXS76BCFmF1OLMHNnZhaV/AM/7e8hNhfASP0GH34/A+sbvduJtKxbzK4QYLudvB1v1Ogrra1L27YIEaa2PW5v4bDQyVNqWe6a1eCmJEUnjXEhdIcFkDIzSxxTFf37wS4ABAHX0lvSAx6CMAAAAAElFTkSuQmCC" /><br>';
						$doNotInstall = true;
					}
					
					//XML
					if(function_exists("simplexml_load_file")){
						$install_info .= '<tr><td>simplexml_load_file()</td><td><img class="true" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0N0I3RTRCODJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0N0I3RTRCOTJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3QjdFNEI2MkNFMjExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQ3QjdFNEI3MkNFMjExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+y7qlaQAAATFJREFUeNpsUTFLw2AQfZcGRKQBBYOgYgtFBzd1EEFBcWlGQRD6F5ycdLQgDq4uCo4VdyF1i4tD8Q+IghEXC920DiGYz3dJqEE9eN+F717uvvdOjDHQOL91HX6tC9BgrjO3ed0iAuJdOXIWjGuuEqeEh7/hE7tEaPFw/iWy9eToGjbnL7y87lg6moWUaArc8tA0VmdPYIn2g6c8K32jGTRLwy6NYKV2BJES7p4Ospqgob+pGCzM7GGpup8W5iZ2MDW2gc7zIT6jbtbBoG4jU70df/WxXGnCGa7ALS8i7F3jpXdTVNG2cnvw8HaJx+4Vau4WEhPhPjxmjovklp376MdJ3+uETU5LoFM+otcBi5J8PjX48Vly+8wvl4U+G/osCKW4QaiNdEdFo7hB4QZJ+xZgAEUmYSGUrvpqAAAAAElFTkSuQmCC" /><br>';
					} else {
						$install_info .= '<tr><td>simplexml_load_file()</td><td><img class="false" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0N0I3RTRCNDJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0N0I3RTRCNTJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3QjdFNEIyMkNFMjExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQ3QjdFNEIzMkNFMjExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+hNZdKwAAAW1JREFUeNqUUUtLQlEQ/s5NzFePayoZUgiGGyNoYw8ryhZ5occ2+gv+iaJN1NIogqIgNy5SKTSIjEgI+gFGi5JWBZqCthCRbjOngrYNDHNm5vvON2eO0HUdbGmnvZPCDPkqeYSqWQHE6Xy9VKrUGCMYnHLavdSICYNB01stfNMBxWiE3mxmKI8ulypFhW9kYN/CojZ9eYV2h1MCLR4PZm/y6J2PaNxnnPIjrbnCc+gKDGH8NIluiqH0GWw+H3qCo8zVJI5GSKQcqs5ePD7S/9rT4YGsE4ZjQiQdap1YNpKCye1G+O4eBqsVzWoVubEgGu9lcI/m/lCEEFnWMdOMk+cZCaw9FGBUVUzQKCaXS76BCFmF1OLMHNnZhaV/AM/7e8hNhfASP0GH34/A+sbvduJtKxbzK4QYLudvB1v1Ogrra1L27YIEaa2PW5v4bDQyVNqWe6a1eCmJEUnjXEhdIcFkDIzSxxTFf37wS4ABAHX0lvSAx6CMAAAAAElFTkSuQmCC" /><br>';
						$doNotInstall = true;
					}
					
					//zip
					if(function_exists("zip_open")){
						$install_info .= '<tr><td>zip_open()</td><td><img class="true" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0N0I3RTRCODJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0N0I3RTRCOTJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3QjdFNEI2MkNFMjExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQ3QjdFNEI3MkNFMjExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+y7qlaQAAATFJREFUeNpsUTFLw2AQfZcGRKQBBYOgYgtFBzd1EEFBcWlGQRD6F5ycdLQgDq4uCo4VdyF1i4tD8Q+IghEXC920DiGYz3dJqEE9eN+F717uvvdOjDHQOL91HX6tC9BgrjO3ed0iAuJdOXIWjGuuEqeEh7/hE7tEaPFw/iWy9eToGjbnL7y87lg6moWUaArc8tA0VmdPYIn2g6c8K32jGTRLwy6NYKV2BJES7p4Ospqgob+pGCzM7GGpup8W5iZ2MDW2gc7zIT6jbtbBoG4jU70df/WxXGnCGa7ALS8i7F3jpXdTVNG2cnvw8HaJx+4Vau4WEhPhPjxmjovklp376MdJ3+uETU5LoFM+otcBi5J8PjX48Vly+8wvl4U+G/osCKW4QaiNdEdFo7hB4QZJ+xZgAEUmYSGUrvpqAAAAAElFTkSuQmCC" /><br>';
					} else {
						$install_info .= '<tr><td>zip_open()</td><td><img class="false" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0N0I3RTRCNDJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0N0I3RTRCNTJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3QjdFNEIyMkNFMjExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQ3QjdFNEIzMkNFMjExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+hNZdKwAAAW1JREFUeNqUUUtLQlEQ/s5NzFePayoZUgiGGyNoYw8ryhZ5occ2+gv+iaJN1NIogqIgNy5SKTSIjEgI+gFGi5JWBZqCthCRbjOngrYNDHNm5vvON2eO0HUdbGmnvZPCDPkqeYSqWQHE6Xy9VKrUGCMYnHLavdSICYNB01stfNMBxWiE3mxmKI8ulypFhW9kYN/CojZ9eYV2h1MCLR4PZm/y6J2PaNxnnPIjrbnCc+gKDGH8NIluiqH0GWw+H3qCo8zVJI5GSKQcqs5ePD7S/9rT4YGsE4ZjQiQdap1YNpKCye1G+O4eBqsVzWoVubEgGu9lcI/m/lCEEFnWMdOMk+cZCaw9FGBUVUzQKCaXS76BCFmF1OLMHNnZhaV/AM/7e8hNhfASP0GH34/A+sbvduJtKxbzK4QYLudvB1v1Ogrra1L27YIEaa2PW5v4bDQyVNqWe6a1eCmJEUnjXEhdIcFkDIzSxxTFf37wS4ABAHX0lvSAx6CMAAAAAElFTkSuQmCC" /><br>';
						$doNotInstall = true;
					}
					
					//Apache Module
					//mod_rewrite
					$modulesarr = apache_get_modules();
					foreach ($modulesarr as $key => $value){
						$g[] = $value;
					}
					if(in_array('mod_rewrite',$g)){
						$install_info .= '<tr><td>mod_rewrite</td><td><img class="true" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0N0I3RTRCODJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0N0I3RTRCOTJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3QjdFNEI2MkNFMjExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQ3QjdFNEI3MkNFMjExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+y7qlaQAAATFJREFUeNpsUTFLw2AQfZcGRKQBBYOgYgtFBzd1EEFBcWlGQRD6F5ycdLQgDq4uCo4VdyF1i4tD8Q+IghEXC920DiGYz3dJqEE9eN+F717uvvdOjDHQOL91HX6tC9BgrjO3ed0iAuJdOXIWjGuuEqeEh7/hE7tEaPFw/iWy9eToGjbnL7y87lg6moWUaArc8tA0VmdPYIn2g6c8K32jGTRLwy6NYKV2BJES7p4Ospqgob+pGCzM7GGpup8W5iZ2MDW2gc7zIT6jbtbBoG4jU70df/WxXGnCGa7ALS8i7F3jpXdTVNG2cnvw8HaJx+4Vau4WEhPhPjxmjovklp376MdJ3+uETU5LoFM+otcBi5J8PjX48Vly+8wvl4U+G/osCKW4QaiNdEdFo7hB4QZJ+xZgAEUmYSGUrvpqAAAAAElFTkSuQmCC" />';
					} else {
						$install_info .= '<tr><td>mod_rewrite</td><td><img class="false" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0N0I3RTRCNDJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0N0I3RTRCNTJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3QjdFNEIyMkNFMjExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQ3QjdFNEIzMkNFMjExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+hNZdKwAAAW1JREFUeNqUUUtLQlEQ/s5NzFePayoZUgiGGyNoYw8ryhZ5occ2+gv+iaJN1NIogqIgNy5SKTSIjEgI+gFGi5JWBZqCthCRbjOngrYNDHNm5vvON2eO0HUdbGmnvZPCDPkqeYSqWQHE6Xy9VKrUGCMYnHLavdSICYNB01stfNMBxWiE3mxmKI8ulypFhW9kYN/CojZ9eYV2h1MCLR4PZm/y6J2PaNxnnPIjrbnCc+gKDGH8NIluiqH0GWw+H3qCo8zVJI5GSKQcqs5ePD7S/9rT4YGsE4ZjQiQdap1YNpKCye1G+O4eBqsVzWoVubEgGu9lcI/m/lCEEFnWMdOMk+cZCaw9FGBUVUzQKCaXS76BCFmF1OLMHNnZhaV/AM/7e8hNhfASP0GH34/A+sbvduJtKxbzK4QYLudvB1v1Ogrra1L27YIEaa2PW5v4bDQyVNqWe6a1eCmJEUnjXEhdIcFkDIzSxxTFf37wS4ABAHX0lvSAx6CMAAAAAElFTkSuQmCC" />';
						$doNotInstall = true;
					}
					if(in_array('mod_security',$g)){
						$install_info .= '<tr><td>mod_security</td><td><img class="true" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0N0I3RTRCODJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0N0I3RTRCOTJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3QjdFNEI2MkNFMjExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQ3QjdFNEI3MkNFMjExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+y7qlaQAAATFJREFUeNpsUTFLw2AQfZcGRKQBBYOgYgtFBzd1EEFBcWlGQRD6F5ycdLQgDq4uCo4VdyF1i4tD8Q+IghEXC920DiGYz3dJqEE9eN+F717uvvdOjDHQOL91HX6tC9BgrjO3ed0iAuJdOXIWjGuuEqeEh7/hE7tEaPFw/iWy9eToGjbnL7y87lg6moWUaArc8tA0VmdPYIn2g6c8K32jGTRLwy6NYKV2BJES7p4Ospqgob+pGCzM7GGpup8W5iZ2MDW2gc7zIT6jbtbBoG4jU70df/WxXGnCGa7ALS8i7F3jpXdTVNG2cnvw8HaJx+4Vau4WEhPhPjxmjovklp376MdJ3+uETU5LoFM+otcBi5J8PjX48Vly+8wvl4U+G/osCKW4QaiNdEdFo7hB4QZJ+xZgAEUmYSGUrvpqAAAAAElFTkSuQmCC" />';
					} else {
						$install_info .= '<tr title="Install mod_security to prevent MySQL injections"><td>mod_security</td><td><img class="false" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0N0I3RTRCNDJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0N0I3RTRCNTJDRTIxMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3QjdFNEIyMkNFMjExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQ3QjdFNEIzMkNFMjExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+hNZdKwAAAW1JREFUeNqUUUtLQlEQ/s5NzFePayoZUgiGGyNoYw8ryhZ5occ2+gv+iaJN1NIogqIgNy5SKTSIjEgI+gFGi5JWBZqCthCRbjOngrYNDHNm5vvON2eO0HUdbGmnvZPCDPkqeYSqWQHE6Xy9VKrUGCMYnHLavdSICYNB01stfNMBxWiE3mxmKI8ulypFhW9kYN/CojZ9eYV2h1MCLR4PZm/y6J2PaNxnnPIjrbnCc+gKDGH8NIluiqH0GWw+H3qCo8zVJI5GSKQcqs5ePD7S/9rT4YGsE4ZjQiQdap1YNpKCye1G+O4eBqsVzWoVubEgGu9lcI/m/lCEEFnWMdOMk+cZCaw9FGBUVUzQKCaXS76BCFmF1OLMHNnZhaV/AM/7e8hNhfASP0GH34/A+sbvduJtKxbzK4QYLudvB1v1Ogrra1L27YIEaa2PW5v4bDQyVNqWe6a1eCmJEUnjXEhdIcFkDIzSxxTFf37wS4ABAHX0lvSAx6CMAAAAAElFTkSuQmCC" />';
					}
					
					$install_info .= '</table>';
					echo $install_info;
					?>
				</td>
			</tr>
		</table>
	</div>
	<h3><a href="#"><? echo $lang_ECMinfo; ?></a></h3>
	<div>
		<table>
			<tr>
				<td>
					<b>Bezeichnung:</b>
				</td>
				<td>
					<? echo $appName; ?>
				</td>
			</tr>
			<tr>
				<td>
					<b><? echo $lang_ECMversion; ?>:</b>
				</td>
				<td>
					<? echo $version; ?> <small><a href="?p=update">(<? echo $lang_ECMsearchUpdate; ?>)</a></small>
				</td>
			</tr>
			<tr>
				<td>
					<b><? echo $lang_ECMbuild; ?>:</b>
				</td>
				<td>
					<? echo $build." (".$buildDate.")"; ?>
				</td>
			</tr>
		</table>
	</div>
	<!--<h3><a href="#"><? echo $lang_license; ?></a></h3>
	<div>
	<?
	/*$activation = file_get_contents($activationURL.'check.php?host='.urlencode($_SERVER["SERVER_NAME"])."&code=".$licenseCode[0]);
	if($activation == "valid"){
		hinweis($lang_licenseValid);
		echo "<h2>".$lang_moreInfo.":</h2>";
		$activationInfo = file_get_contents($activationURL.'licenseInfo.php?host='.urlencode($_SERVER["SERVER_NAME"])."&code=".$licenseCode[0]);
		echo $activationInfo;
	} else if($activation){
		fehler($lang_licenseUnknownError);

	} else {
		fehler($lang_license404);
	}*/
	?>
	</div>-->
	<h3><a href="#">Credits</a></h3>
	<div>
		<h4>Personen:</h4>
		<table border="1" width="100%">
			<tr>
				<td>
					<b>Programmierung:</b>
				</td>
				<td>
					Felix Deil
				</td>
			</tr>
			<tr>
				<td>
					<b>Übersetzung:</b>
				</td>
				<td>
					Felix Deil
				</td>
			</tr>
			<tr>
				<td>
					<b>Grafiken:</b>
				</td>
				<td>
					Felix Deil<br>
					<a href="https://github.com/janh97" target="_BLANK">janh97</a>
				</td>
			</tr>
		</table>
		<br>
		<h4>jQuery-Plugins:</h4>
		<table border="1" width="100%">
			<tr>
				<td>
					<b>DataTables:</b>
				</td>
				<td>
					by SpryMedia<br>
					<a href="http://www.datatables.net/index" target="_blank">DataTables website</a>
				</td>
			</tr>
			<!--<tr> vorläufig entfernt
				<td>
					<b>jQuery Mega Drop Down Menu:</b>
				</td>
				<td>
					by Design Chemical<br>
					<a href="http://www.designchemical.com/lab/jquery-mega-drop-down-menu-plugin/getting-started/" target="_blank">jQuery Mega Drop Down Menu website</a>
				</td>
			</tr>-->
			<tr>
				<td>
					<b>Lightbox:</b>
				</td>
				<td>
					by Leandro Vieira Pinho<br>
					<a href="http://leandrovieira.com/projects/jquery/lightbox/" target="_blank">Lightbox website</a>
				</td>
			</tr>
			<tr>
				<td>
					<b>Socialshareprivacy:</b>
				</td>
				<td>
					by Heise Online<br>
					<a href="http://www.heise.de/ct/artikel/2-Klicks-fuer-mehr-Datenschutz-1333879.html" target="_blank">Socialshareprivacy website</a>
				</td>
			</tr>
			<tr>
				<td>
					<b>tinyMCE:</b>
				</td>
				<td>
					by tinyMCE<br>
					<a href="http://www.tinymce.com/" target="_blank">tinyMCE website</a>
				</td>
			</tr>
		</table>
		<br>
		<a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.de"><img alt="Creative Commons Lizenzvertrag" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Baru CMS</span> von <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Felix Deil</span> steht unter einer <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.de">Creative Commons Namensnennung - Weitergabe unter gleichen Bedingungen 3.0 Unported Lizenz</a>.
	</div>
</div>
<?
} else {
	fehler($lang_noPermission);
}
?>