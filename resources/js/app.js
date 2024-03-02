import "./bootstrap";

const channel = window.Echo.channel("public.sendEmail");

channel.subscribed(() => {
    console.log("subscribed");
});

channel.listen("SendEmail", () => {
    alert("working");
});
