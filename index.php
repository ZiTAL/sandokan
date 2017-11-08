<?php
if(isset($_GET['isLocked']) && $_GET['isLocked']==='true')
{
	clearstatcache();
	$file = realpath("./tmp/lock");
	if($file)
		echo 1;
	else
		echo 0;
	exit();
}
elseif(isset($_POST) && count($_POST)>0)
{
	preg_match("/https?:\/\/[^\s$]+$/", $_POST['url'], $m);
	if($m)
	{
		$url = $m[0];
		$tech = '';
		if(preg_match("/^https?:\/\/(youtu\.be|(www\.)?youtube\.com)\//", $url))
			$tech = 'youtube-dl';
		if($tech!=='')
		{
			$dir = realpath(dirname(__FILE__));
			$dir = realpath($dir."/libs");
			$command = "php {$dir}/{$tech}.php {$url} > /dev/null 2>&1 &";
			//$command = "php {$dir}/{$tech}.php {$url}";
			shell_exec($command);
		}
	}
	header("location: {$_SERVER['REQUEST_URI']}");
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>SANDOKAN - YOUTUBE</title>
<style type="text/css">
html,body
{
	width: 100%;
}
div
{
	clear: both;
	width: 50%;
	margin: 0 auto;
	text-align: center;
}
img.logo
{
	display: block;
	margin: 0 auto;
/*
	width: 64px;
	height: 64px;
*/
}
img.ready
{
	display: none;
	margin: 0 auto;
	background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADEAAABACAYAAACz4p94AAAFPUlEQVRoge2ZbYhUVRjHz/qGFpVhWawbDEil5ltt7uzM3DnnzM6d8zyiFQTzqRCEQIjY+hBZQTVqL+DWRiKERNrqOjN7nhMllB+M+iAVFr4EaaW9GYIVERS+ZAZOH9Z1z529u/Ny745f7h/up3PP8zy/5zznOYd7GYsUKVKkSJEiRYrUUiV1brkw8Bo3eCzz7spKrUcYPCoJXnXKmWVXN/IKa0sTPCA0fllP4OM90qgDDqnVrMLaWhp/QrtLuIHPggTvszr704PZRZMffYW1SVJPSsL/fLNK6ogg7OekHnJKKp4s98xPDPTMS5Z75jslFU8P5R4WhP1C41f+q4IXhVG9k7YqsUJspiDU1Y454d/C4Ob47tztjdhzytk7OGGfNHjGZ1WKeZ2fESpA57bOa7hWH3uzjpckwVbng1U3BrHdNdA1hxO8KQkveUA07OvoT8wKC2C6ILW3CuC0U3JlKA4uK13KZYWG3zyrrHEPK7BpgY2LIdxSVbffrijx20KIe4y6SzLGNRyvKte+QEY5uQ96DBr14wotbw0pZl+lSql2YeCk7dchtbopY8t3yNn28gqDZxNFuSDkmH2VLKvF0uA/VvmeuvPt1HUNGxKE/XY20gSPTEK8w03D4IeOBvT6V496qwBfachwvJi9xc6EIPycMTYlzOAZ83Y9QXjBBsnr/NQMwUG7EjqL8qa6jXNSL3hqcsh1JxPASpYHJK3dVd5xeLZe+1Okxp/ty1rYJ6gfgC9IhbXZ3YprOF5XLJn3VnV6WxysbxWA1cZ3jbwvCJ6zx1LFzF01nXCC9fakhHaXtBJAEGr7gKtOqiR4oqYjqZGsUvqLhbShmwFgbHiDC4NnR7sU7K7pTBg8Orqs6sDVBBiRNHjYKrXDNR1yg39emaCRWgHADQxNdEeSBO+PQsCvNZ1Kgxetlrbd7x1OuEkQbGwFwOWYdlmN5lxgCE64yRofFyQsgKYgJionQbBxTC0b2DCZAIw1U04avvbb2MLAhnH7OmFhsgAY825srvFQHRBjW2x8S/x6afD7CQ8owkK9AHmdn1ovACuwaXaLlYSDNecIgqdsp+lidiljjMUHZUdNEIM/hQrAGEuVcvd6bGh4vOakdLnnHk9gWj09MpYY6JlXCyRMAMbGXkbrunYwxqbYGeUGj9mXrmZAmgUYjgVOWOX9Xd2XUaHheU8Q5ZyyxxsBkUaVmwRgYkjdN15V1FRyZ3KuNOr8aG/GL1jVHWoYZDRLYQPkdX6qJHXE2m9nuga65jRkhBP2eVaDcuuq35kIJAgAY4wJo3q99uDFho242r1BEp62gjrvt6lSpVR7NUhQAKecWSYIL1h76pelfUuvbcoY17n77eCEgZOpUqp9IpCgAPFB2SEJT9l+qz8iNKzqrx7SwInukoz5gQiDm4MAJMs984XGH7ydrcGvHL4qsGlc4x7v/sDfhVa54MZHJUitlAR/VCXMBEmKRx39iVlCw74xm5fgrbu3p28OYju5MzlXEGyvti1I7Y0VYjNDARhRXudncAO7xxxkBOf4ELxe70l6JfiyWiwI37BbudVO3+nc1jk9VIArqrA2qeExbuBf/5MZj0mCrYJgraNdp7vsLuwuyVh32V3oaNcRBGslwVap1Td+8wXhBU65dS359ZUoygXCwCfN3KHGPxjxo0Z/1ARXhbWlh1yQRn0aJHhhcL/QKtfyH4/VSg9mFwlSL3ONh2pmnPBShuCgIHipVV/ZG9bwL4FsghOsEUb1CsJnhFG9nGCN0NnE8h1y9tWOMVKkSJEiRYoUqUn9DzyTDiT8rZf1AAAAAElFTkSuQmCC);
	width: 49px;
	height: 64px;
}
img.busy
{
	display: block;
	margin: 0 auto;
	background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADEAAABACAYAAACz4p94AAAFhElEQVRoge2ZXWwVRRTHp3wFNEYMigZrUoMfgHxUK23vvTszNQJqRKSGTVvu3TlDYooClj4YURP1xY9EFKMh8cGEmCjGFB7khQeMkhAlaArVSKWlvb07MwQ1xkTDh1hM14e2dHbvbu/u3kvxYf/JvvTOzDm/OTPnnO4ilChRokSJEiVKlGhKVUhvrJWYvysJ9J5p2uSUehTmJyWBd4aM3Ipr6riDUJXE7ElF+fdhHA8GYseEwdY6CFVNKUA+lV0mCP+2HOe9j6T8iMDZJVfdeQehKkngeUnZZT9HBOU9klq7bALZgmE1DKRbFvanzNsH0i0LC4bVIDDLSWrtUpj94BsVCsOCQsdVi8rhmqbZZyjvKtpBwv8SlL2db9h4d5T18kbLPZLATknZueKosM+6THNWRQG669qvU4R/5Qn/iCSwWxgbbypn7VP1zfMEgQ8l5SOe9Q8drU7NqRTATEXhoCfsZwtGrqkiBsYkcPZhSeBXd5ThgIOaZpS9uKL8A8+5PzW4svWOCvhdpEJja40kvN8DsrOsRW1iPeWKAIF870rzNn3MYCp3Vzk2vPP7Mq0LBGa2a+MMtjbW4j216+fq4ZWEny+k2hbpYyRhLZKyywqzbXFsCMw7JWWXBWYb9L8Ppq2livK/J44vU333rrshsgFJrV36btiYPV0EQPi/WtGKBCIw79SyURGIpGyL+xSwtyIBDDW03arvhKBw1EFoWhBAVBBB2HaftOoCcUxzusS8Wz8J/XXtN4eGUIS95jmTq1y/Y7ZtkjZiUhA/gCspG/Nn9LE2hsc9oC+HAnAQmiYpL+jNml8FjQMiKHQEA8CzPr5U6dlKEt4fqpqffQjqXFEgbEfQ2CggUQHGJTF/RR8/kGm7rySEIGyHPimfyi6bbHwYEIHZc3EAEPLZVMw7S0IoyvZpdeFP/ULHA4H9cQEQGrvghJ+f8InvLQ2B+UltJ4+VnBACJC7AuASFE1qmPFHaGQJ/aEVmX1hDYUGiAiCEkMT8iwmf+C+lHaEwrKW0PVGMlQKJAzDqE/tkIkPBhasOEXSJpxaijOMUlEaLQCjbEmXdGMeJ/RTnYocBiAviutiEHw8DETnFTtpKEP6597827biWBHFQ0wx3ioVPQ0DAC7qhIdy2PDbA2PmXlG2JC5LPWA+6ih1h20tC2Dj3gHsSfzEQQGunS11gb2vtGk9ga5ANbzMaqu0YbQBhSDPQ69d0RQGIC+IgNE1RfvrKhmLWF/p1jqLwqsfAGhdAiCMUpCggwrCeCHsqijSYbp6vKL+oXabv9AsuMNvgfYEWpQZIAlu9AIrCsG2w5vExjmlOF5T3aHfn3Kn65nmhIcYM7fRcqM367zpIrFZCA/ECIFScsiWB1yMBIIRQflX7jYrCWa3IXPReKoHZBkVhOE4VRmi0RVGE/+MFGDJyKxSBSxMAXPy4fM31cWwgSWCdKxqY2X2Z1gX6GLveujPW4gHzBxqy1YoypdstGLlHy7FR9NZDUX660NhaU9aiARpItyxUmA+67EV9y+Gn0YoJBzxZ4jeRya2ugN9XZGfYY5Ky310AGPY7pjm9IgaOVqfmSMoP+WSUjwbuN28pZ+3BdPN8Sdken7UPHq5pml0RgHF1meYsRfhen9x+QRJ4L1QldTlvLVUE3tdTuRbpj7vr2mdWFGBcDkJV4xkloFj1SgK7pQGbhMEMu9FaXGhsrbEbrcXCYIY0YJMksFtQ+NlvviJwSRC2eUo+fRVSbYsUha+DKm+cR1D2ZdQPNWXLQaiqgK1HBObflOO8pPyIyORWT/mHR68Ezi6RFN4UhB8P4fSIxLxbYv6G9y37/0Y9tevn2mmWEgSYoNAhMLwkKHQIAsxOs1RP7fq519rHRIkSJUqUKFGimPoPtoFaldEbhcsAAAAASUVORK5CYII=);
	width: 49px;
	height: 64px;
}
iframe
{
	width: 100%;
	display: block;
	border: 0;
	padding: 0;
	margin: 0;
}
</style>
<script type="text/javascript">
(function()
{
	var iframe;
	var src;
	var status = '1';
	var ready;
	var busy;
	var refresh_time = 15;

	function init()
	{
		ready = document.querySelector('.ready');
		busy = document.querySelector('.busy');

		iframe = document.querySelector('iframe');
		resize();

		isLocked();
	}

	function reloadIframe()
	{
		var src = iframe.src;
		iframe.src = '';
		window.setTimeout(function()
		{
			iframe.src = src;
		}, 250);
	}

	function resize()
	{
		var height = "innerHeight" in window ? window.innerHeight : document.documentElement.offsetHeight;
		height = height - 70;
		iframe.style.height = height + "px";
	}

	function isLocked()
	{
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'index.php?isLocked=true');
		xhr.onreadystatechange = function ()
		{
			if(xhr.readyState === 4)
			{
				if(xhr.status===200)
				{
					if(xhr.responseText!==status)
					{
						if(xhr.responseText==='1')
						{
							ready.style.display = 'none';
							busy.style.display = 'block';
						}
						else if(xhr.responseText==='0')
						{
							ready.style.display = 'block';
							busy.style.display = 'none';
							reloadIframe();
						}
						status = xhr.responseText;
					}
				}

				window.setTimeout(function()
				{
					isLocked();
				}, refresh_time * 1000);
			}
		};
		xhr.send(null);
	}

	window.onload = function()
	{
		init();
	};

	window.onresize = function()
	{
		resize();
	};
})();
</script>
</head>
<body>
<div>
		<img class="logo" src="https://cdn3.iconfinder.com/data/icons/free-social-icons/67/youtube_circle_color-64.png" alt="youtube" />
</div>
<div>
	<form method="post">
		<img class="ready" src="" alt="" />
		<img class="busy" src="" alt="" />
		<label>URL youtube:</label>
		<input type="text" name="url">
		<input type="submit">
	</form>
</div>
<iframe src="/sandokan/downloads"></iframe>
</body>
</html>
