import { Grid } from "@mui/material";
import SettingsIcon from '@mui/icons-material/Settings';
import { RouteMapBlock } from "@irontec/ivoz-ui/router/routeMapParser";
import DashboardItemList from './DashboardItemList';

interface LinkBlockProps {
    routeMapBlock: RouteMapBlock
}
const DashboardBlock = (props: LinkBlockProps): JSX.Element => {

    const { label, children } = props.routeMapBlock;

    if (label) {
        return (
            <Grid item lg={4} md={6} xs={12}>
                <ul>
                    <li className="submenu">
                        <h3>
                            <SettingsIcon />
                            {label}
                        </h3>
                        <div>
                            <DashboardItemList items={children || []} />
                        </div>
                    </li>
                </ul>
            </Grid>
        );
    }

    return (
        <Grid item lg={4} md={6} xs={12}>
            <DashboardItemList items={children || []} />
        </Grid>
    );
}

export default DashboardBlock;