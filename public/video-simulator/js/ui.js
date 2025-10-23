/**
 * Video Simulator - UI Connection
 * Connecte les contrôles HTML aux fonctions p5.js
 */

(function() {
    'use strict';

    console.log('🎮 UI Module loading...');

    // ============================================
    // TOGGLE SIDEBAR
    // ============================================

    document.getElementById('toggleSidebar').addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('hidden');
    });

    // ============================================
    // SWITCH TABS
    // ============================================

    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', (e) => {
            const tabName = e.target.dataset.tab;

            // Masquer tous les onglets
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.querySelectorAll('.tab').forEach(t => {
                t.classList.remove('active');
            });

            // Afficher l'onglet sélectionné
            document.getElementById(`${tabName}-tab`).classList.add('active');
            e.target.classList.add('active');

            // Changer le mode de forme
            if(typeof setShapeMode === 'function') {
                setShapeMode(tabName === 'circle' ? 'circle' : 'triangle');
            }
        });
    });

    // ============================================
    // CONTRÔLES CERCLE
    // ============================================

    document.getElementById('gapSlider').addEventListener('input', (e) => {
        const value = e.target.value;
        document.getElementById('gapValue').textContent = value + '°';
        if(typeof setPortalSizeFromDegrees === 'function') {
            setPortalSizeFromDegrees(parseFloat(value));
        }
    });

    document.getElementById('speedSlider').addEventListener('input', (e) => {
        const value = e.target.value;
        document.getElementById('speedValue').textContent = value + 'x';
        if(typeof setRotationSpeed === 'function') {
            setRotationSpeed(parseFloat(value));
        }
    });

    document.getElementById('gravityCheckbox').addEventListener('change', (e) => {
        if(typeof setGravityEnabled === 'function') {
            setGravityEnabled(e.target.checked);
        }
    });

    document.getElementById('soundCheckbox').addEventListener('change', (e) => {
        if(typeof setSfxEnabled === 'function') {
            setSfxEnabled(e.target.checked);
        }
    });

    document.getElementById('volumeSlider').addEventListener('input', (e) => {
        const value = e.target.value;
        document.getElementById('volumeValue').textContent = value + '%';
        if(typeof setSfxVolume === 'function') {
            setSfxVolume(parseFloat(value) / 100);
        }
    });

    // ============================================
    // CONTRÔLES TRIANGLE/POLYGONE
    // ============================================

    document.getElementById('polygonModeCheckbox').addEventListener('change', (e) => {
        if(typeof setPolygonMode === 'function') {
            setPolygonMode(e.target.checked);
        }
    });

    document.getElementById('sidesSlider').addEventListener('input', (e) => {
        const value = e.target.value;
        document.getElementById('sidesValue').textContent = value;
    });

    document.getElementById('triGapSlider').addEventListener('input', (e) => {
        const value = e.target.value;
        document.getElementById('triGapValue').textContent = value + '°';
        if(typeof setTriangleGapDegrees === 'function') {
            setTriangleGapDegrees(parseFloat(value));
        }
    });

    document.getElementById('triSpeedSlider').addEventListener('input', (e) => {
        const value = e.target.value;
        document.getElementById('triSpeedValue').textContent = value + 'x';
        if(typeof setTriangleRotationSpeed === 'function') {
            setTriangleRotationSpeed(parseFloat(value));
        }
    });

    document.getElementById('triGravityCheckbox').addEventListener('change', (e) => {
        if(typeof setGravityEnabled === 'function') {
            setGravityEnabled(e.target.checked);
        }
    });

    // ============================================
    // TOOLBAR BUTTONS
    // ============================================

    document.getElementById('playBtn').addEventListener('click', () => {
        if(typeof startSim === 'function') startSim();
    });

    document.getElementById('pauseBtn').addEventListener('click', () => {
        if(typeof stopSim === 'function') stopSim();
    });

    document.getElementById('resetBtn').addEventListener('click', () => {
        if(typeof resetSim === 'function') resetSim();
    });

    document.getElementById('recordBtn').addEventListener('click', () => {
        if(typeof toggleRecord === 'function') toggleRecord();
    });

    // ============================================
    // INITIALISATION
    // ============================================

    window.addEventListener('load', () => {
        // Initialiser les valeurs des sliders
        document.getElementById('gapSlider').dispatchEvent(new Event('input'));
        document.getElementById('speedSlider').dispatchEvent(new Event('input'));
        document.getElementById('volumeSlider').dispatchEvent(new Event('input'));
        document.getElementById('triGapSlider').dispatchEvent(new Event('input'));
        document.getElementById('triSpeedSlider').dispatchEvent(new Event('input'));

        console.log('✅ UI Module loaded');
    });

})();
