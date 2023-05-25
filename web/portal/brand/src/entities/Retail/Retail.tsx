import _ from '@irontec/ivoz-ui/services/translations/translate';
import ShoppingBasketIcon from '@mui/icons-material/ShoppingBasket';

import Company from '../Company/Company';

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
    'invoicing.nif',
    'billingMethod',
    'outgoingDdi',
    'routingTagIds',
    'codecIds',
    'featureIds',
  ],
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default Retail;
