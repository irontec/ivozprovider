import defaultEntityBehavior, { EntityFormProps } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import RatingPlanGroupSelectOptions from 'entities/RatingPlanGroup/SelectOptions';
import RoutingTagSelectOptions from 'entities/RoutingTag/SelectOptions';
import { RatingProfilePropertyList } from './RatingProfileProperties';
import axios, { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: RatingProfilePropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = RatingPlanGroupSelectOptions(
        (options: any) => {
            response.ratingPlanGroup = options;
        },
        token
    );

    promises[promises.length] = RoutingTagSelectOptions(
        (options: any) => {
            response.routingTag = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const [fkChoices, setFkChoices] = useState<any>({});

    useEffect(
        () => {

            let mounted = true;

            const CancelToken = axios.CancelToken;
            const source = CancelToken.source();

            foreignKeyGetter(source.token).then((options) => {

                if (!mounted) {
                    return;
                }

                setFkChoices((fkChoices: any) => {
                    return {
                        ...fkChoices,
                        ...options
                    }
                });
            });

            return () => {
                mounted = false;
                source.cancel();
            }
        },
        []
    );

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} />);
}

export default Form;