import { Footer } from "./Footer";
import { Navbar } from "./Navbar";
import { Signin } from "./Signin";

export function Layout({ children }) {
    return (
        <div style={{
            display: 'flex',
            flexDirection: 'column',
            minHeight: '100vh'
        }}>
            <Navbar />
            <main className="container mt-4 flex-grow-1">
                {children}
            </main>
            <Footer />
            <Signin />
        </div>
    );
}
