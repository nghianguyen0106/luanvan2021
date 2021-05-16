 var don_huy = document.getElementById('don_hang_huy');
    var don_moi = document.getElementById('don_hang_moi');
    var don_giao = document.getElementById('don_hang_giao');
    var don_xong = document.getElementById('don_hang_xong');

    don_huy.style.display = 'none';
    don_moi.style.display = 'block';
    don_giao.style.display = 'none';
    don_xong.style.display = 'none';

    function show_huy()
    {
    	don_huy.style.display = 'block';
	    don_moi.style.display = 'none';
	    don_giao.style.display = 'none';
	    don_xong.style.display = 'none';
    }
    function show_moi()
    {
    	don_huy.style.display = 'none';
	    don_moi.style.display = 'block';
	    don_giao.style.display = 'none';
	    don_xong.style.display = 'none';
    }
    function show_giao()
    {
    	don_huy.style.display = 'none';
	    don_moi.style.display = 'none';
	    don_giao.style.display = 'block';
	    don_xong.style.display = 'none';
    }
    function show_xong()
    {
    	don_huy.style.display = 'none';
	    don_moi.style.display = 'none';
	    don_giao.style.display = 'none';
	    don_xong.style.display = 'block';
    }