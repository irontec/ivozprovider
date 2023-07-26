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
  link: '/doc/en/administration_portal/brand/clients/residential.html',
  title: _('Residential', { count: 2 }),
  localPath: '/residential',
  columns: [
    'name',
    'invoicing.nif',
    'billingMethod',
    'outgoingDdi',
    'featureIds',
  ],
};

export default Residential;
