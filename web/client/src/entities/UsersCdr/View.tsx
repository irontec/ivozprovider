import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import EntityService from 'services/Entity/EntityService';
import { foreignKeyResolver } from './UsersCdr';
import { useState, useEffect } from 'react';

const View = (props: any) => {

    const { row, entityService } : { row:any, entityService:EntityService } = props;
    const [parsedValues, setParsedValues] = useState<any>({});

    const [parsedFks, setParsedFks] = useState<boolean>(false);
    useEffect(
        () => {
            foreignKeyResolver([row], entityService).then((data:any) => {
                setParsedValues(data[0]);
                setParsedFks(true);
            });
        },
        [row, setParsedFks, entityService]
    );

    if (!parsedFks) {
        return null;
    }

    return (<defaultEntityBehavior.View row={parsedValues} {...props} />);
}

export default View;