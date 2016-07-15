<div class="sesion-user">
    <p class="par-ses">Bienvenido usuario <strong><?php echo $_SESSION[user_name]; ?></strong></p>
    <?php if($_SESSION[user_id]){?><a href="../logout.php" class="out">Salir</a><?php }?>
</div>