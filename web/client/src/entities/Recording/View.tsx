import defaultEntityBehavior, { FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { ViewProps } from 'lib/entities/EntityInterface';

const View = (props: ViewProps): JSX.Element | null => {

    const groups: Array<FieldsetGroups | false> = [
        {
            legend: '',
            fields: [
                'caller',
                'callee',
                'duration',
                'recordedFile',
                'typeGhost',

            ]
        }
    ];

    return (<defaultEntityBehavior.View {...props} groups={groups} />);
}

export default View;