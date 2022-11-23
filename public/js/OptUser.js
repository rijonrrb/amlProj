document.getElementById("cdept").onclick = function() {
    document.getElementById("idept").style.display = "none";
    document.getElementById("sdept").disabled = false;
    document.getElementById("idept").disabled = true;
    document.getElementById("sdept").style.display = "block";
    document.getElementById("cdept").style.display = "none";
    }
    
    document.getElementById("cdes").onclick = function() {
    document.getElementById("ides").style.display = "none";
    document.getElementById("sdes").disabled = false;
    document.getElementById("ides").disabled = true;
    document.getElementById("sdes").style.display = "block";
    document.getElementById("cdes").style.display = "none";
    }
    