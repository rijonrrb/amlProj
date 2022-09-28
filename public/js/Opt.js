document.getElementById("cdept").onclick = function() {
    document.getElementById("idept").style.display = "none";
    document.getElementById("sdept").disabled = false;
    document.getElementById("idept").disabled = true;
    document.getElementById("sdept").style.display = "block";
    document.getElementById("cdept").style.display = "none";
    }
    
    
    document.getElementById("H_cdept").onclick = function() {
    document.getElementById("H_idept").style.display = "none";
    document.getElementById("H_sdept").disabled = false;
    document.getElementById("H_idept").disabled = true;
    document.getElementById("H_sdept").style.display = "block";
    
    document.getElementById("H_cdept").style.display = "none";
    }