import Company from '../Company/Company';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';

const Wholesale = {
  ...Company,
  icon: ShoppingCartIcon,
  title: _('Wholesale', { count: 2 }),
  localPath: '/wholesale',
  columns: [
    'name',
    'nif',
    'billingMethod',
    //@TODO RoutingTags
    //@TODO Audio Transcoding
  ],
};

export default Wholesale;
