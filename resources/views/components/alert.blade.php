@persist('alert')
    <div x-data="{
        alerts: [],
        add: function(alert) {
            if (this.alerts.length >= 1) {
                this.remove(this.alerts[0].id);
            }
    
            alert.id = this.alerts.length + 1;
    
            alert.timer = setTimeout(() => {
                this.remove(alert.id);
            }, 5000);
    
            this.alerts.push(alert);
        },
        remove: function(id) {
            this.alerts = this.alerts.filter((alert) => alert.id !== id);
        }
    }" x-on:alert.window="add($event.detail)">
        <template x-for="alert in alerts">
            <div class="mt-8 px-4 sm:px-6 lg:px-8">
                <div x-ref="alert">
                    <div class="flex items-center justify-between rounded border-l-4 px-4 py-2"
                        x-bind:class="{
                            'bg-blue-50 text-blue-700 border-blue-500': alert.type === 'info',
                            'bg-green-50 text-green-700 border-green-500': alert.type === 'success',
                            'bg-yellow-50 text-yellow-700 border-yellow-500': alert.type === 'warning',
                            'bg-red-50 text-red-700 border-red-500': alert.type === 'danger',
                        }"
                    >
                        <p x-text="alert.message"></p>

                        <button x-on:click.prevent="remove(alert.id)">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>
@endpersist
