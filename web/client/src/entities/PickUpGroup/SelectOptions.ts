import defaultEntityBehavior from '../DefaultEntityBehavior';
import pickUpGroup from './PickUpGroup';

const PickUpGroupSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        pickUpGroup.path,
        ['id', 'name'],
        (data:any) => {

            const options:any = {};
            for (const item of data) {
                options[item.id] = item.name;
            }

            callback(options);
        }
    );
}

export default PickUpGroupSelectOptions;