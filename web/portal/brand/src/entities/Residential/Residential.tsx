import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import HouseIcon from '@mui/icons-material/House';

import Company from '../Company/Company';

const Residential: EntityInterface = {
  ...Company,
  properties: {
    ...Company.properties,
    outgoingDdi: {
      label: _('Fallback Outgoing DDI'),
      null: _('Unassigned'),
      default: '__null__',
    },
  },
  initialValues: {
    type: 'residential',
  },
  icon: HouseIcon,
  title: _('Residential', { count: 2 }),
  localPath: '/residential',
  columns: [
    'name',
    'invoicing.nif',
    'billingMethod',
    'outgoingDdi',
    'featureIds',
    'invoicing.postalAddress',
    'invoicing.postalCode',
    'invoicing.town',
    'invoicing.province',
    'invoicing.countryName',
  ],
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
};

export default Residential;
