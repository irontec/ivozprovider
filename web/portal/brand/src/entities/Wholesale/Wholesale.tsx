import _ from '@irontec/ivoz-ui/services/translations/translate';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';

import Company from '../Company/Company';

const Wholesale = {
  ...Company,
  icon: ShoppingCartIcon,
  link: '/doc/${language}/administration_portal/brand/clients/wholesale.html',
  title: _('Wholesale', { count: 2 }),
  localPath: '/wholesale',
  columns: [
    'name',
    'invoicing.nif',
    'billingMethod',
    'routingTagIds',
    'codecIds',
  ],
};

export default Wholesale;
