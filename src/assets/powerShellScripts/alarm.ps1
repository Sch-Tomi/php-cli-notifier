$PlayWav = New-Object System.Media.SoundPlayer
$PlayWav.SoundLocation = $args[0]
$PlayWav.playsync()
