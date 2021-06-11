import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import genericForeignKeyResolver from 'services/genericForeigKeyResolver';
import EntityService from 'services/Entity/EntityService';
import defaultEntityBehavior from '../DefaultEntityBehavior';
import _ from 'services/Translations/translate';

const properties:PropertiesList = {
    id:  {
        label: "id",
    },
    ddi: {
        label: "ddi",
    },
    duration: {
        label: "duration",
    },
    price: {
        label: "price"
    },
};

async function foreignKeyResolver(data: any, entityService: EntityService) {

    data = await genericForeignKeyResolver(
        data,
        'ddi',
        '/ddis',
        'ddi'
    );

    return data;
}

const calendar:EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'BillableCall',
    title: _('Billable calls', {count: 2}),
    path: '/billable_calls',
    properties,
    foreignKeyResolver,

};

export default calendar;