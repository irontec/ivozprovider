import Company from '../Company/Company';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';
import Form from './Form';

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
  Form,
};

export default Wholesale;
