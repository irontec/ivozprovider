import defaultEntityBehavior, { EntityFormProps } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import RatingPlanGroupSelectOptions from 'entities/RatingPlanGroup/SelectOptions';
import RoutingTagSelectOptions from 'entities/RoutingTag/SelectOptions';
import { RatingProfilePropertyList } from './RatingProfileProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: RatingProfilePropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = RatingPlanGroupSelectOptions((options: any) => {
        response.ratingPlanGroup = options;
    });

    promises[promises.length] = RoutingTagSelectOptions((options: any) => {
        response.routingTag = options;
    });

    await Promise.all(promises);

    return response;
};

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [mounted, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {

            if (mounted && loadingFks) {

                foreignKeyGetter().then((options) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            ...options
                        }
                    });
                });

                setLoadingFks(false);
            }

            return function umount() {
                setMounted(false);
            };
        },
        [mounted, loadingFks, fkChoices]
    );

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} />);
}

export default Form;