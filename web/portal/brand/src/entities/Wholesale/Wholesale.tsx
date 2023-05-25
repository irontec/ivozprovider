import _ from '@irontec/ivoz-ui/services/translations/translate';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';

import Company from '../Company/Company';

const Wholesale = {
  ...Company,
  icon: ShoppingCartIcon,
  title: _('Wholesale', { count: 2 }),
  localPath: '/wholesale',
  columns: [
    'name',
    'invoicing.nif',
    'billingMethod',
    'routingTagIds',
    'codecIds',
  ],
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default Wholesale;
