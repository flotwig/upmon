<?php
require('global.php');
$servers = $conn->query('SELECT * FROM `servers` WHERE `group`=' . intval($_GET['group']) . ' ORDER BY `desc`,`server`,`port`;') or die('unable to load servers...' . CRLF);
$group = $conn->query('SELECT * FROM `groups` WHERE `id`=' . intval($_GET['group']) . ' LIMIT 1;') or die('unable to load group from db...');
$group = $group->fetch(PDO::FETCH_ASSOC) or die('unable to load group...');
switch ($_GET['format']) {
	case 'json':
		header('Content-type: application/json');
		echo json_encode(
			$servers->fetch_all(MYSQLI_ASSOC),
			JSON_NUMERIC_CHECK
		);
		break;
	case 'badge':
		header('Content-type: image/png');
		$allchecks = 0;
		$allgood = 0;
		while ($server = $servers->fetch(PDO::FETCH_ASSOC)) {
			$allchecks = $allchecks + $server['checks'];
			$allgood = $allgood + $server['good'];
		}
		$pct = ($allgood/$allchecks)*100;
		$pct = round($pct,2);
		$im = imagecreate(80, 15);
		$bg = imagecolorallocate($im, 255, 255, 255);
		$textcolor = imagecolorallocate($im, 0, 0, 255);
		$b = imagecolorallocate($im,0,0,0);
		imagerectangle($im, 0, 0, 79, 14, $b);
		imagefilledrectangle($im,41,0,79,14,$b);
		imagestring($im, 2, 3, 1, $pct . '%', $b);
		imagestring($im, 2, 43, 1, 'uptime', $bg);
		imagepng($im);
		imagedestroy($im);
		break;
	default:
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
		if (isset($group['name'])) {
			echo '<title>',$group['name'],' @ ',VERSION,'</title>
				<meta name="description" content="Historical uptime data for ' . $group['name'] . '.">';
		} else {
			echo '<title>',VERSION,' @ ',$_SERVER['HTTP_HOST'],'</title>
				<meta name="description" content="Monitors many servers for uptime and collects and displays that data.">';
		}
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="http://hostigation.chary.us/static/css/bootstrap.css" rel="stylesheet"> <!-- bootstrap -->
		<style>
			body {
				padding-top: 60px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div style="float:right;">
				Badge for this page: <img src="<?php echo BASE; ?>?format=badge&amp;group=<?php echo intval($_GET['group']); ?>"><br>
				JSON API for this page: <a href="<?php echo BASE; ?>?format=json&amp;group=<?php echo intval($_GET['group']); ?>" rel="nofollow">
					<?php echo BASE; ?>?format=json&amp;group=<?php echo intval($_GET['group']); ?>
					</a>
			</div>
			<?php
			if (isset($group['name'])) {
				echo '<h1>',$group['name'],' @ ',VERSION,'</h1>';
			} else {
				echo '<h1>',VERSION,' @ ',$_SERVER['HTTP_HOST'],'</h1>';
			}
			?>
			<table class="table table-striped table-bordered table-condensed">
				<thead><tr><td style="width:17px;"></td><th>Service</th><th style="width:60px;">Uptime</th><td style="width:200px;"></td></tr></thead>
				<tbody>
<?php
$totalchecks = 0;
$totalservers = 0;
while ($server = $servers->fetch(PDO::FETCH_ASSOC)) { 
	$totalchecks += $server['checks'];
	$totalservers++;
?>
					<tr>
						<td><img src="<?php echo $server['current']; ?>.png" style="height:15px;width:15px;" alt="<?php echo $server['current']; ?>"></td>
						<td><strong><?php echo $server['server']; ?></strong>:<?php echo $server['port']; ?>
							<?php if (!empty($server['desc'])) { ?> <em>(<?php echo $server['desc']; ?>)</em><?php }?></td>
						<td><?php echo ($server['good']/$server['checks'])*100; ?>%</td>
						<td><img src="./progbar.php?t=<?php echo $server['checks']; ?>&amp;u=<?php echo $server['good']; ?>"></td>
					</tr>
<?php } ?>
				</tbody>
			</table>
			<div>
				<em>These statistics are for informational purposes. Statistics are collected every <?php echo COLLECTED; ?> minute(s) and changes are
					reflected immediately.<br/>
					This set of servers has been monitored for <?php echo number_format(floor(($totalchecks/$totalservers)/1440)*COLLECTED); ?> days and <?php echo number_format((($totalchecks/$totalservers)%24)*COLLECTED); ?> hours.</em>
			</div>
			<span style="float:right;text-transform:lowercase;">
				<a href="https://www.niftyhost.us/" style="color:#eeeeee;">Free Web Hosting</a>
				<a href="http://za.chary.us/" style="color:#dddddd;">Zach Bloomquist</a>
			</span>
		</div>
	</body>
</html>
<?php
		break;
};
?>