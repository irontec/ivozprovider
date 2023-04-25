import Company from '../Company/Company';
import { foreignKeyGetter } from './ForeignKeyGetter';
import HouseIcon from '@mui/icons-material/House';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';

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
  foreignKeyGetter,
};

export default Residential;
