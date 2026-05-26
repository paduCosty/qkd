if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').catch(() => {});
    });
}

document.addEventListener('alpine:init', () => {
    Alpine.store('confirm', {
        show: false,
        message: '',
        _action: null,
        open(message, action) {
            this.message = message;
            this._action = action;
            this.show = true;
        },
        commit() {
            if (this._action) this._action();
            this.show = false;
            this._action = null;
        },
        cancel() {
            this.show = false;
            this._action = null;
        },
    });
});
