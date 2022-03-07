import { FkChoices } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import axios from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import EntityService, { EntityValues } from 'lib/services/entity/EntityService';
import { match } from 'react-router-dom';

interface useFkChoicesArgs {
    foreignKeyGetter: ForeignKeyGetterType,
    entityService: EntityService,
    row?: EntityValues,
    match: match
}

const useFkChoices = (props: useFkChoicesArgs): FkChoices => {

    const { foreignKeyGetter, entityService, row, match } = props;
    const [fkChoices, setFkChoices] = useState<FkChoices>({});

    useEffect(
        () => {

            let mounted = true;

            const CancelToken = axios.CancelToken;
            const source = CancelToken.source();

            foreignKeyGetter({
                cancelToken: source.token,
                entityService,
                row,
                match,
            }).then((options) => {

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
        [foreignKeyGetter, entityService, row, match]
    );

    return fkChoices;
}

export default useFkChoices;