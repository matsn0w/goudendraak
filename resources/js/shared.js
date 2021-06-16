export default {
    euro(price) {
        let f = new Intl.NumberFormat('nl-NL', {
            style: 'currency',
            currency: 'EUR',
        });

        return f.format(price);
    },

    menuItemsSearched() {
        const s = this.search?.toLowerCase();

        return this.items.filter((item) => {
            if (item.name?.toLowerCase().includes(s)) {
                return true;
            }

            if (item.category?.name.toLowerCase().includes(s)) {
                return true;
            }

            if (`${item.number}` == s
                || item.number_addition?.toLowerCase().includes(s)) {
                return true;
            }

            return false;
        });
    },
}
