import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import pickUpGroup from './OutgoingDdiRulesPattern';

const PickUpGroupSelectOptions: SelectOptionsType = ({ callback, cancelToken }): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        pickUpGroup.path,
        ['id', 'name'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                options[item.id] = item.name;
            }

            callback(options);
        },
        cancelToken
    );
}

export default PickUpGroupSelectOptions;