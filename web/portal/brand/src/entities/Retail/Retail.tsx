import Company from '../Company/Company';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ShoppingBasketIcon from '@mui/icons-material/ShoppingBasket';

const Retail = {
  ...Company,
  properties: {
    ...Company.properties,
    outgoingDdi: {
      label: _('Fallback Outgoing DDI'),
      null: _('Unassigned'),
      default: '__null__',
    },
  },
  icon: ShoppingBasketIcon,
  title: _('Retail', { count: 2 }),
  localPath: '/retail',
  columns: [
    'name',
    'nif',
    'billingMethod',
    'outgoingDdi',
    //@TODO RoutingTags
    //@TODO Audio Transcoding
    'featureIds',
  ],
};

export default Retail;
