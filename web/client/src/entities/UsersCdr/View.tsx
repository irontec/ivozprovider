import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import EntityService from 'lib/services/entity/EntityService';
import { foreignKeyResolver } from './UsersCdr';
import { useState, useEffect } from 'react';
import { ViewProps } from 'lib/entities/EntityInterface';

const View = (props: ViewProps): JSX.Element | null => {

    const { row, entityService }: { row: any, entityService: EntityService } = props;
    const [parsedValues, setParsedValues] = useState<any>({});
    const [mounted, setMounted] = useState<boolean>(true);

    const [parsedFks, setParsedFks] = useState<boolean>(false);
    useEffect(
        () => {

            if (mounted) {
                foreignKeyResolver([row]).then((data: any) => {

                    if (!mounted) {
                        return;
                    }

                    setParsedValues(data[0]);
                    setParsedFks(true);
                });
            }

            return function umount() {
                setMounted(false);
            };
        },
        [mounted, row, setParsedFks, entityService]
    );

    if (!parsedFks) {
        return null;
    }

    return (<defaultEntityBehavior.View {...props} row={parsedValues} />);
}

export default View;