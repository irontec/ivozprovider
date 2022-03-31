import ApartmentIcon from '@mui/icons-material/Apartment';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { LocationProperties } from './LocationProperties';
import selectOptions from './SelectOptions';
import Form from "./Form";

const properties: LocationProperties = {
    name: {
        label: _('Name'),
    },
    description: {
        label: _('Description'),
    },
};

const columns = [
    'name',
    'description',
];

const location: EntityInterface = {
    ...defaultEntityBehavior,
    icon: ApartmentIcon,
    iden: 'Location',
    title: _('Location', { count: 2 }),
    path: '/locations',
    toStr: (row: any) => row?.name || '',
    properties,
    columns,
    Form,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};
export default location;