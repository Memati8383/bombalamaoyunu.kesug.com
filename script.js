document.addEventListener('DOMContentLoaded', function() {
    var typed = new Typed('.typed-text', {
        strings: ["SMS OYUNU"],
        typeSpeed: 130, // Yazı hızı
        backSpeed: 65, // Silme hızı
        loop: true // Döngü
    });
});

function updateZaman() {
    var yeniZaman = new Date();
    document.getElementById("zaman").innerHTML = yeniZaman.toLocaleString();
}

// Her saniye zamanı güncellemek için zamanlayıcı kullanabilirsiniz
setInterval(updateZaman, 1000); // Her 1000 milisaniyede (1 saniye) güncelle

// Yeni metinleri içeren bir dizi oluşturun
const textArray = [
    "Yazılıma olan tutkumu projelerimde hayata geçiriyorum.",
    // Diğer metinleri burada ekleyebilirsiniz
];
const textElement = document.querySelector(".typewriter-text");
let textArrayIndex = 0;
let charIndex = 0;
let isDeleting = false;

function type() {
    const currentText = textArray[textArrayIndex];

    if (isDeleting) {
        textElement.textContent = currentText.substring(0, charIndex - 1);
        charIndex--;
    } else {
        textElement.textContent = currentText.substring(0, charIndex + 1);
        charIndex++;
    }

    if (charIndex === currentText.length + 1) {
        isDeleting = true;
        charIndex = currentText.length;
        setTimeout(type, 1000); // Yazı tamamlandığında bekleme süresi 1 saniye
    } else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        textArrayIndex++;
        if (textArrayIndex === textArray.length) textArrayIndex = 0;
        setTimeout(type, 200); // Yazı tamamen silindiğinde bekleme süresi 0.2 saniye
    } else {
        setTimeout(type, 50); // Harf yazım veya silme hızı 0.05 saniye
    }
}

// İlk daktilo yazısını başlat
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(type, 1000);
});
// sayfdan ayrılınca gösterilen bildirim

function showNotification(message) {
    if (Notification.permission === "granted") {
        new Notification("🔔 Ferit Akdemir - SMS OYUNU", {
            body: message,
            icon: "fotolar/icon.jpg", // pc bildirim ikonu
            badge: "fotolar/icon.jpg", // mobil bildirim ikonu
            vibrate: [200, 100, 200], // Titreşim pattern'ı
        });
    } else if (Notification.permission !== 'denied') {
        Notification.requestPermission().then(function(permission) {
            if (permission === "granted") {
                showNotification(message);
            }
        });
    }
}

var originalTitle = document.title;

document.addEventListener("visibilitychange", function() {
    if (document.visibilityState === 'hidden') {
        // Sayfa sekmeden ayrılınca bildirim göster
        showNotification("Sekmeden ayrıldınız. Lütfen geri dönünüz.");
        document.title = "🔔 Bildirim Var!";
    } else {
        document.title = originalTitle;
    }
});
