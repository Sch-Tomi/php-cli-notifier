Add-Type -AssemblyName System.Windows.Forms
$global:balloon = New-Object System.Windows.Forms.NotifyIcon
$path = (Get-Process -id $pid).Path
$balloon.Icon = [System.Drawing.Icon]::ExtractAssociatedIcon($path)
$balloon.BalloonTipIcon = [System.Windows.Forms.ToolTipIcon]::Info
$balloon.BalloonTipText = $args[1]
$balloon.BalloonTipTitle = $args[0]
$balloon.Visible = $true
$balloon.ShowBalloonTip(5000)
