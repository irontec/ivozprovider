import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface from 'entities/EntityInterface';
import genericForeignKeyResolver from 'services/genericForeigKeyResolver';
import EntityService from 'services/Entity/EntityService';
import defaultEntityBehavior from '../DefaultEntityBehavior';
import _ from 'services/Translations/translate';

const columns = {
    id: "id",
    ddi: "ddi",
    duration: "duration",
    price: "price"
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
    title: _('billable calls'),
    path: '/billable_calls',
    columns,
    foreignKeyResolver,

};

export default calendar;